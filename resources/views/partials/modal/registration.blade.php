<div class="modal fade" id="complete-registration" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Completa tu información</h4>
            </div>
            <div class="modal-body">
            {!! Form::model($user, ['route' => ['panel.profile', $user->id], 'method' => 'put']) !!}
            {!! Form::hidden('name', old('name')) !!}
            {!! Form::hidden('email', old('email')) !!}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <p>Es necesario que nos proporciones tu ubicación, esta es utilizada al publicar los artículos para comunicar a los demas usuarios si te encuentras cerca.</p>
                        <br>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6  @if ($errors->has('state_id')) has-error @endif">
                                    {!! Form::label('state', 'Estado', ['class' => 'control-label']) !!}
                                    {!! Form::select(
                                        'state_id',
                                        ['' => '-- Seleccionar --'] + $states->toArray(),
                                        null,
                                        ['class' => 'form-control', 'id' => 'state'])
                                    !!}
                                    @if ($errors->has('state_id'))
                                    <span class="help-block">* {{ $errors->first('state_id') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6 @if ($errors->has('city_id')) has-error @endif">
                                    {!! Form::label('city', 'Ciudad', ['class' => 'control-label']) !!}
                                    {!! Form::select(
                                        'city_id',
                                        ['' => '-- Seleccionar --'],
                                        null,
                                        ['class' => 'form-control', 'id' => 'city', 'disabled' => 'disabled'])
                                    !!}
                                    @if ($errors->has('city_id'))
                                    <span class="help-block">* {{ $errors->first('city_id') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {!! Form::button('Guardar', [
                    'class'             => 'btn btn-lg btn-primary btn-block',
                    'type'              => 'submit',
                    'data-loading-text' => '<i class="fa fa-cog fa-spin"></i> Enviando...',
                    'id'                => 'register-button'
                ]) !!}
            </div>
            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(window).bind("load", function() {
        $('#complete-registration').modal({
            backdrop: 'static',
            show: true
        });
    });

    $(document).ready(function() {
        $('select#state').change(function() {
            var state_id = $(this).val();
            loadCities(state_id, true);
        });
        $('#register-button').on('click', function () {
            var $btn = $(this).button('loading');
        });
        @if (count($errors) > 0)
            $('select#state').trigger('change');
        @endif
    });
</script>
