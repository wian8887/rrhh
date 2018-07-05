@extends('layouts.app') 
@section('title','Editar contrato') 
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Editar contrato</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/">Inicio</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/contract">contratos</a>
            </li>            
            <li class="breadcrumb-item active">
                <strong>editar contrato</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2" align="right">
        <ul class="breadcrumb m-t-md">
            <li><button class="btn btn-outline btn-primary dim" type="button"><a href="/contract"><i class="fa fa-reply"></i> volver </a></button></li>
        </ul>
        
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="ibox ">
            <div class="ibox-title">
                
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-4">&nbsp;</div>
                    <div class="col-lg-4">
                        <form method="POST" action="{{action('ContractController@update', $contract->id)}}">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PATCH">
                            <div class="form-group row">
                                <div class="col-md-4">Empleado</div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled value="{{$employee->fullName()}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">C.I. </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled value="{{$employee->identity_card}}"  >
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">Cargo: <span class="text-danger">*</span></div>
                                <div class="col-md-8">
                                    <input type="hidden" name="position_id" id="position_id" class="form-control" value=" {{ $contract->position_id }} " />
                                    <input type="text" id="position" placeholder="Cargo" class="form-control" value=" {{ $contract->position->name }} " /> <<div class="text-danger">{{ $errors->first('position_id') }}</div>                                   
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">Fecha de inicio <span class="text-danger">*</span></div>
                                <div class="col-md-8">
                                    <input type="date" name="date_start" value="{{ $contract->date_start }}" class="form-control">
                                    <div class="text-danger">{{ $errors->first('date_start') }}</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">Fecha de fin <span class="text-danger">*</span></div>
                                <div class="col-md-8">
                                    <input type="date" name="date_end" value="{{ $contract->date_end }}" class="form-control">
                                    <div class="text-danger">{{ $errors->first('date_end') }}</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">Numero de asegurado 
                                    <i class="fa fa-comment" type="button" data-toggle="tooltip" data-placement="top" title="Ejemplo: 11-1111-XXX"></i>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="number_insurance" value="{{ $contract->number_insurance }}" class="form-control">
                                </div>
                            </div>                            
                            <div class="form-group row">
                                <div class="col-md-4">Cite de Resursos Humanos <span class="text-danger">*</span> 
                                    <i class="fa fa-comment" type="button" data-toggle="tooltip" data-placement="top" title="Ejemplo: RR.HH.-120/2018"></i>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="cite_rrhh" value="{{ $contract->cite_rrhh }}" class="form-control">
                                    <div class="text-danger">{{ $errors->first('cite_rrhh') }}</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">Fecha del cite <span class="text-danger">*</span></div>
                                <div class="col-md-8">
                                    <input type="date" name="cite_rrhh_date" value="{{ $contract->cite_rrhh_date }}" class="form-control">
                                    <div class="text-danger">{{ $errors->first('cite_rrhh_date') }}</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">Numero de convocatoria 
                                    <i class="fa fa-comment" type="button" data-toggle="tooltip" data-placement="top" title="Ejemplo: URH-028"></i>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="numer_announcement" value="{{ $contract->numer_announcement }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4"> Cite de desempeño
                                    <i class="fa fa-comment" type="button" data-toggle="tooltip" data-placement="top" title="Solo en caso de recontratación"></i>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="cite_performance" value="{{ $contract->cite_performance }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">Contrato Vigente:</div>
                                <div class="col-md-8">
                                    @if ($contract->status)
                                        <input style="transform: scale(1.5);"  type="checkbox" checked name="status">
                                    @else
                                        <input style="transform: scale(1.5);"  type="checkbox" name="status">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12" align="right">
                                <button type="submit" class="btn btn-primary">guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('jss')
<script type="text/javascript">
    $('#position').typeahead({
        source: <?= $position ?>,
        displayText: function(item) {
            return item.name
        },
        afterSelect: function(item) {
            $('#position_id').val(item.id);
        }
    });
</script>
@endsection