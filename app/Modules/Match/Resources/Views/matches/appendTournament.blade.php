@if($tournaments)
    @foreach ($tournaments as $tournament)
        <option value="{{ $tournament->id}}">{{ ucfirst($tournament->tournamentName)}}</option>
    @endforeach
@endif