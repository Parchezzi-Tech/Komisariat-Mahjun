<?php

namespace App\Filament\Pmii\Resources;

use App\Filament\Pmii\Resources\SuratResource\Pages;
use App\Models\Surat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Auth;

class SuratResource extends Resource
{
    protected static ?string $model = Surat::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    
    protected static ?string $navigationLabel = 'Generator Surat';
    
    protected static ?string $modelLabel = 'Surat';
    
    protected static ?string $pluralModelLabel = 'Generator Surat';
    
    protected static ?int $navigationSort = 1;
    
    protected static ?string $navigationGroup = 'Administrasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Surat')
                    ->schema([
                        Forms\Components\Select::make('jenis_surat')
                            ->label('Jenis Surat')
                            ->options([
                                'Surat Tugas' => 'Surat Tugas',
                                'Surat Keterangan' => 'Surat Keterangan',
                                'Surat Undangan' => 'Surat Undangan',
                                'Surat Rekomendasi' => 'Surat Rekomendasi',
                                'Surat Pengantar' => 'Surat Pengantar',
                            ])
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                // Auto generate nomor surat berdasarkan jenis
                                $set('nomor_surat', ''); // Will be generated on save
                            }),
                        Forms\Components\TextInput::make('nomor_surat')
                            ->label('Nomor Surat')
                            ->disabled()
                            ->dehydrated(false)
                            ->placeholder('Otomatis dibuat saat menyimpan')
                            ->helperText('Nomor surat akan dibuat otomatis'),
                        Forms\Components\DatePicker::make('tanggal_surat')
                            ->label('Tanggal Surat')
                            ->default(now())
                            ->required(),
                    ])
                    ->columns(3),
                    
                Forms\Components\Section::make('Konten Surat')
                    ->schema([
                        Forms\Components\TextInput::make('perihal')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('kepada')
                            ->label('Kepada')
                            ->required()
                            ->rows(2)
                            ->helperText('Contoh: Yth. Bapak/Ibu Kepala Desa')
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('isi_surat')
                            ->label('Isi Surat')
                            ->required()
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'bulletList',
                                'orderedList',
                            ])
                            ->columnSpanFull(),
                    ]),
                    
                Forms\Components\Section::make('Penandatangan')
                    ->schema([
                        Forms\Components\TextInput::make('penandatangan')
                            ->label('Nama Penandatangan')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('jabatan_penandatangan')
                            ->label('Jabatan')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('signature_path')
                            ->label('Tanda Tangan Digital')
                            ->image()
                            ->directory('signatures')
                            ->visibility('public')
                            ->imageEditor()
                            ->helperText('Upload gambar tanda tangan (PNG/JPG dengan background transparan)'),
                    ])
                    ->columns(3),
                    
                Forms\Components\Section::make('Status & Keterangan')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'Draft' => 'Draft',
                                'Final' => 'Final',
                                'Terkirim' => 'Terkirim',
                            ])
                            ->default('Draft')
                            ->required(),
                        Forms\Components\Textarea::make('keterangan')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nomor_surat')
                    ->label('Nomor Surat')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenis_surat')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Surat Tugas' => 'info',
                        'Surat Keterangan' => 'success',
                        'Surat Undangan' => 'warning',
                        'Surat Rekomendasi' => 'primary',
                        'Surat Pengantar' => 'gray',
                    })
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('perihal')
                    ->searchable()
                    ->limit(30)
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_surat')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('penandatangan')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Draft' => 'gray',
                        'Final' => 'success',
                        'Terkirim' => 'info',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jenis_surat')
                    ->options([
                        'Surat Tugas' => 'Surat Tugas',
                        'Surat Keterangan' => 'Surat Keterangan',
                        'Surat Undangan' => 'Surat Undangan',
                        'Surat Rekomendasi' => 'Surat Rekomendasi',
                        'Surat Pengantar' => 'Surat Pengantar',
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Draft' => 'Draft',
                        'Final' => 'Final',
                        'Terkirim' => 'Terkirim',
                    ]),
            ])
            ->actions([
                Action::make('generatePdf')
                    ->label('Generate PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('success')
                    ->url(fn (Surat $record): string => route('surat.pdf', $record))
                    ->openUrlInNewTab(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSurats::route('/'),
            'create' => Pages\CreateSurat::route('/create'),
            'view' => Pages\ViewSurat::route('/{record}'),
            'edit' => Pages\EditSurat::route('/{record}/edit'),
        ];
    }
}
