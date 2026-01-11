<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnggotaResource\Pages;
use App\Filament\Resources\AnggotaResource\RelationManagers;
use App\Models\Anggota;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\FileUpload;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class AnggotaResource extends Resource
{
    protected static ?string $model = Anggota::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    
    protected static ?string $navigationLabel = 'Anggota';
    
    protected static ?string $modelLabel = 'Anggota';
    
    protected static ?string $pluralModelLabel = 'Data Anggota';
    
    protected static ?int $navigationSort = 1;
    
    protected static ?string $navigationGroup = 'Data Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Pribadi')
                    ->schema([
                        Forms\Components\TextInput::make('nim')
                            ->label('NIM')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\TextInput::make('nama')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('no_hp')
                            ->label('No. HP')
                            ->tel()
                            ->maxLength(255),
                        Forms\Components\Select::make('jenis_kelamin')
                            ->label('Jenis Kelamin')
                            ->options([
                                'Laki-laki' => 'Laki-laki',
                                'Perempuan' => 'Perempuan',
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('alamat')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                    
                Forms\Components\Section::make('Data Akademik')
                    ->schema([
                        Forms\Components\TextInput::make('fakultas')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('prodi')
                            ->label('Program Studi')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('angkatan')
                            ->maxLength(255),
                    ])
                    ->columns(3),
                    
                Forms\Components\Section::make('Data Keanggotaan')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'Aktif' => 'Aktif',
                                'Non-Aktif' => 'Non-Aktif',
                                'Alumni' => 'Alumni',
                            ])
                            ->default('Aktif')
                            ->required(),
                        Forms\Components\DatePicker::make('tanggal_masuk')
                            ->label('Tanggal Masuk'),
                        Forms\Components\FileUpload::make('foto')
                            ->image()
                            ->directory('anggota-photos')
                            ->visibility('public'),
                        Forms\Components\Textarea::make('keterangan')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')
                    ->circular()
                    ->defaultImageUrl(url('/images/default-avatar.png')),
                Tables\Columns\TextColumn::make('nim')
                    ->label('NIM')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('no_hp')
                    ->label('No. HP')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Laki-laki' => 'info',
                        'Perempuan' => 'success',
                    })
                    ->toggleable(),
                Tables\Columns\TextColumn::make('fakultas')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('prodi')
                    ->label('Prodi')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('angkatan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Aktif' => 'success',
                        'Non-Aktif' => 'danger',
                        'Alumni' => 'warning',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_masuk')
                    ->date()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Aktif' => 'Aktif',
                        'Non-Aktif' => 'Non-Aktif',
                        'Alumni' => 'Alumni',
                    ]),
                Tables\Filters\SelectFilter::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->options([
                        'Laki-laki' => 'Laki-laki',
                        'Perempuan' => 'Perempuan',
                    ]),
                Tables\Filters\SelectFilter::make('angkatan')
                    ->options(fn () => Anggota::distinct()->pluck('angkatan', 'angkatan')->toArray()),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->exports([
                            ExcelExport::make()
                                ->fromTable()
                                ->withFilename(fn () => 'anggota-' . date('Y-m-d'))
                                ->withColumns([
                                    Tables\Columns\TextColumn::make('nim')->label('NIM'),
                                    Tables\Columns\TextColumn::make('nama'),
                                    Tables\Columns\TextColumn::make('email'),
                                    Tables\Columns\TextColumn::make('no_hp')->label('No HP'),
                                    Tables\Columns\TextColumn::make('jenis_kelamin')->label('Jenis Kelamin'),
                                    Tables\Columns\TextColumn::make('fakultas'),
                                    Tables\Columns\TextColumn::make('prodi'),
                                    Tables\Columns\TextColumn::make('angkatan'),
                                    Tables\Columns\TextColumn::make('status'),
                                    Tables\Columns\TextColumn::make('tanggal_masuk')->label('Tanggal Masuk'),
                                ]),
                        ]),
                ]),
            ])
            ->headerActions([
                Action::make('downloadTemplate')
                    ->label('Download Template Excel')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->url(route('anggota.template'))
                    ->openUrlInNewTab(),
                Action::make('import')
                    ->label('Import Excel')
                    ->icon('heroicon-o-arrow-up-tray')
                    ->color('warning')
                    ->form([
                        FileUpload::make('file')
                            ->label('File Excel')
                            ->acceptedFileTypes(['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'text/csv'])
                            ->disk('local')
                            ->directory('imports')
                            ->required(),
                    ])
                    ->action(function (array $data) {
                        try {
                            $filePath = storage_path('app/' . $data['file']);
                            \Maatwebsite\Excel\Facades\Excel::import(new \App\Imports\AnggotaImport, $filePath);
                            
                            \Filament\Notifications\Notification::make()
                                ->title('Import Berhasil')
                                ->success()
                                ->body('Data anggota berhasil diimport!')
                                ->send();
                        } catch (\Exception $e) {
                            \Filament\Notifications\Notification::make()
                                ->title('Import Gagal')
                                ->danger()
                                ->body('Error: ' . $e->getMessage())
                                ->send();
                        }
                    }),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAnggotas::route('/'),
            'create' => Pages\CreateAnggota::route('/create'),
            'edit' => Pages\EditAnggota::route('/{record}/edit'),
        ];
    }
}
