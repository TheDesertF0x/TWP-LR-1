<tr style="background-color: rgba(256,0,0,.25);">
    <td align="center" valign="center">
        <a href="/cups/{{ $cup->id }}">{{ $cup->getYearAttribute() }}</a>
    </td>
    <td align="center" valign="center">
        {{ $cup->getPlaceAttribute() }}
    </td>
    <td align="center" valign="center">
        {{ $cup->getCountryAttribute() }}
    </td>
    <td align="center" valign="center">
        {{ $cup->getWinnerAttribute() }}
    </td>
    <td align="center" valign="center">
        <img src="{{ asset($cup->getWinnerLogoAttribute()) }}" style="width: 120px; height: 115px">
    </td>
    <td align="center" valign="center">
        <a href={{ route('users.show', ['user'=>$cup->getOwnerNameAttribute()]) }}>
            {{ $cup->getOwnerNameAttribute() }}
        </a>
    </td>
    <td class="icon">
        <form action="/cups/{{$cup->id}}/restore" method="post">
            @csrf
            <button><i class="fa fa-undo"></i></button>
        </form>
        <form action="/cups/{{$cup->id}}/force_delete" method="post">
            @csrf
            @method('DELETE')
            <button><i class="fa fa-trash-alt"></i></button>
        </form>
    </td>
</tr>
