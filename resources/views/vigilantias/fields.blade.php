<!-- Pesquisa Field -->
<div class="form-group col-sm-12">
	<div class="custom-control custom-radio">
      <input type="hidden" name="pesquisa" value="0">
      <input class="custom-control-input" type="radio" id="pesquisa" name="pesquisa" value="1" 
          {{($vigilancia->pesquisa ?? 0) ? 'checked' : ''}}>
      <label for="pesquisa" class="custom-control-label">Pesquisa</label>
    </div>
</div>

<!-- Dip Field -->
<div class="form-group col-sm-12">
	<div class="custom-control custom-radio">
      <input type="hidden" name="dip" value="0">
      <input class="custom-control-input" type="radio" id="dip" name="dip" value="1" 
          {{($vigilancia->dip ?? 0) ? 'checked' : ''}}>
      <label for="dip" class="custom-control-label">Dip</label>
    </div>
</div>

<!-- Procedemientos Cirugias Field -->
<div class="form-group col-sm-12">
    <div class="custom-control custom-radio">
      <input type="hidden" name="procedimientos_cirugias" value="0">
      <input class="custom-control-input" type="radio" id="procedimientos_cirugias" name="procedimientos_cirugias" value="1" 
          {{($vigilancia->procedimientos_cirugias ?? 0) ? 'checked' : ''}}>
      <label for="procedimientos_cirugias" class="custom-control-label">Procedimientos y Cirugías</label>
    </div>
</div>

<!-- Paa Field -->
<div class="form-group col-sm-12">
    <div class="custom-control custom-radio">
      <input type="hidden" name="paa" value="0">
      <input class="custom-control-input" type="radio" id="paa" name="paa" value="1" 
          {{($vigilancia->paa ?? 0) ? 'checked' : ''}}>
      <label for="paa" class="custom-control-label">PAA</label>
    </div>

</div>

<!-- Comentarios Field -->
<div class="form-group col-sm-6">
    {!! Form::label('comentarios', 'Comentarios:') !!}
    {!! Form::text('comentarios', null, ['class' => 'form-control']) !!}
</div>
