<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ParticipantResource\Pages;
use App\Models\Event;
use App\Models\Participant;
use App\Models\Payment;
use App\Models\RunnerKit;
use App\Models\TshirtMovement;
use App\Models\TshirtWharehouse;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
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
                Forms\Components\TextInput::make('fullName')
                    ->label('Nome Completo')
                    ->required()
                    ->placeholder('Nome do Participante'),
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->placeholder('Email'),
                Forms\Components\TextInput::make('phone')
                    ->label('Telefone')
                    ->required()
                    ->placeholder('Telefone'),
                Forms\Components\DatePicker::make('dateBorn')
                    ->label('Data de Nascimento')
                    ->required()
                    ->placeholder('Data de Nascimento'),
                Forms\Components\Select::make('sizeTshirt')
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
                Forms\Components\TextInput::make('responsableName')
                    ->label('Nome do Responsável')
                    ->placeholder('Nome do Responsável'),
                Forms\Components\Select::make('event_id')
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
                Tables\Columns\TextColumn::make('payment.status')
                    ->label('Status do Pagamento')
                    ->sortable(),
                Tables\Columns\TextColumn::make('runnerKit.status')
                    ->label('Status do Kit')
                    ->sortable(),
            ])
            ->filters([
                // filtrar por evento mostrando o nome do evento
                Tables\Filters\SelectFilter::make('event_id')
                    ->label('Evento')
                    ->options(fn() => Event::pluck('name', 'id')->toArray())
                    ->default('all'),
                // filtrar por status do pagamento
//                Tables\Filters\SelectFilter::make('payment.status')
//                    ->label('Status do Pagamento')
//                    ->options([
//                        'all' => 'Todos',
//                        'pending' => 'Pendente',
//                        'paid' => 'Pago',
//                    ])
//                    ->default('all'),
            ])
            ->actions([
                Action::make('receberPagamento')
                    ->label('Receber Pagamento')
                    ->requiresConfirmation()
                    ->color('primary')
                    ->action(fn(Participant $record) => $record->payment()->update(['status' => 'paid', 'paymentDate' => now()]))
                    ->visible(fn(Participant $record) => $record->payment && $record->payment->status !== 'paid')
                    ->icon('heroicon-o-currency-dollar'),
                Action::make('entregarKit')
                    ->label('Entregar Kit')
                    ->requiresConfirmation()
                    ->color('primary')
                    ->action(fn(Participant $record) => tap($record->runnerKit)->update([
                        'status' => 'delivered',
                        'deliveredDate' => now(),
                    ]))
                    ->visible(fn(Participant $record) => $record->runnerKit && $record->runnerKit->status !== 'delivered')
                    ->icon('heroicon-s-gift'),
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
