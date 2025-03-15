<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ParticipantResource\Pages;
use App\Filament\Resources\ParticipantResource\RelationManagers;
use App\Models\Participant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ParticipantResource extends Resource
{
    protected static ?string $model = Participant::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                'fullName' => Forms\Components\TextInput::make('fullName')
                    ->label('Nome Completo')
                    ->required()
                    ->placeholder('Nome do Participante'),
                'email' => Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->placeholder('Email'),
                'phone' => Forms\Components\TextInput::make('phone')
                    ->label('Telefone')
                    ->required()
                    ->placeholder('Telefone'),
                'dateBorn' => Forms\Components\DatePicker::make('dateBorn')
                    ->label('Data de Nascimento')
                    ->required()
                    ->placeholder('Data de Nascimento'),
                'sizeTshirt' => Forms\Components\Select::make('sizeTshirt')
                    ->label('Tamanho da T-Shirt')
                    ->required()
                    ->options([
                        '8-10' => '8-10',
                        '10-12' => '10-12',
                        'S' => 'S',
                        'M' => 'M',
                        'L' => 'L',
                        'XL' => 'XL',
                        'XXL' => 'XXL',
                    ]),
                'responsableName' => Forms\Components\TextInput::make('responsableName')
                    ->label('Nome do Responsável')
                    ->placeholder('Nome do Responsável'),
                'event_id' => Forms\Components\Select::make('event_id')
                    ->label('Evento')
                    ->required()
                    ->relationship('event', 'name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('event.name')
                    ->label('Evento')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fullName')
                    ->label('Nome Completo')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Telefone')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('dateBorn')
                    ->label('Data de Nascimento')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sizeTshirt')
                    ->label('Tamanho da Camiseta')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('responsableName')
                    ->label('Nome do Responsável')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListParticipants::route('/'),
            'create' => Pages\CreateParticipant::route('/create'),
            'view' => Pages\ViewParticipant::route('/{record}'),
            'edit' => Pages\EditParticipant::route('/{record}/edit'),
        ];
    }
}
