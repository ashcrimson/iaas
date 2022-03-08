<style>
    .fa-2x {
        font-size: 1.2em;
        margin-top: 10px;
    }
</style>



        <a href="#" onclick="deleteItemDt(this)" data-id="{{$solicitud->id}}" data-toggle="tooltip" title="Eliminar" class='btn btn-danger btn-sm'>
            <i class="fa fa-trash-alt"></i>
        </a>


        <form action="{{ route('solicitudes.destroy', $solicitud->id)}}" method="POST" id="delete-form{{$solicitud->id}}">
            @method('DELETE')
            @csrf
        </form>


