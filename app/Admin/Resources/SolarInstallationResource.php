<?php

namespace App\Admin\Resources;

use App\Admin\Resources\SolarInstallationResource\Pages;
use App\Admin\Resources\SolarInstallationResource\RelationManagers;
use App\Models\SolarInstallation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SolarInstallationResource extends Resource
{
    protected static ?string $model = SolarInstallation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('energy_audit_id')
                    ->numeric(),
                Forms\Components\TextInput::make('technician_id')
                    ->numeric(),
                Forms\Components\TextInput::make('system_size')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('panel_count')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('estimated_production')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('installation_date')
                    ->required(),
                Forms\Components\DatePicker::make('completion_date'),
                Forms\Components\TextInput::make('status')
                    ->required(),
                Forms\Components\TextInput::make('project_files'),
                Forms\Components\TextInput::make('warranty_period')
                    ->required()
                    ->numeric()
                    ->default(25),
                Forms\Components\Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('energy_audit_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('technician_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('system_size')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('panel_count')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('estimated_production')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('installation_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('completion_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('warranty_period')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListSolarInstallations::route('/'),
            'create' => Pages\CreateSolarInstallation::route('/create'),
            'edit' => Pages\EditSolarInstallation::route('/{record}/edit'),
        ];
    }
}
