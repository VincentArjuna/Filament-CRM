<?php

namespace App\Filament\Resources\OrganizationResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Squire\Models\Country;

class ContactsRelationManager extends RelationManager
{
    protected static string $relationship = 'contacts';

    protected static ?string $recordTitleAttribute = 'email';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')->required(),
                Forms\Components\TextInput::make('last_name')->required(),
                Forms\Components\TextInput::make('email')->unique(
                    ignorable: fn (null|Model $record): null|Model => $record
                )->email()->required(),
                Forms\Components\TextInput::make('phone')->tel()->required(),
                Forms\Components\TextInput::make('address')->required(),
                Forms\Components\TextInput::make('city')->required(),
                Forms\Components\TextInput::make('region')->required(),
                Forms\Components\Select::make('country')
                    ->options(
                        Country::query()->pluck('name', 'code_2')
                    )->searchable()->required(),
                Forms\Components\TextInput::make('postal_code')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('last_name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('phone')->searchable(),
                Tables\Columns\TextColumn::make('city')->sortable(),
                Tables\Columns\TextColumn::make('countryName.name')->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AssociateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DissociateAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DissociateBulkAction::make(),
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public function mutateFormDataBeforeCreate(array $data): array
    {
        $data['account_id'] = auth()->user()->account_id;
        return $data;
    }
}
