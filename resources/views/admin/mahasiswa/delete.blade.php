<form action="/mahasiswa/{{ $mahasiswa->mahasiswa_id }}/destroy" method="post" class="d-inline">
@method('delete')
@csrf
              
<!-- Modal -->
<div class="modal fade" id="ModalDelete{{$mahasiswa->mahasiswa_id}}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{ __('Hapus Mahasiswa')}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">Yakin akan menghapus <b> {{$mahasiswa->nama}}</b></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel')}}</button>
        <button type="submit" class="btn btn-danger">{{ __('Hapus')}}</button>
      </div>
    </div>
  </div>
</div>  
</form>