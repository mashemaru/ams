@extends('layouts.app', ['title' => __('Document Outlines Management')])
@php

function buildTree($elements, $parentId = 0) {
    // print_r($elements);
    $branch = array();
// die();
    foreach ($elements as $element) {
        if ($element['parent_id'] == $parentId) {
            $children = buildTree($elements, $element['id']);
            if ($children) {
                $element['children'] = $children;
            }
            $branch[] = $element;
        }
    }

    return $branch;
}
@endphp
@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        @foreach($accreditations as $accreditation_doc)
        <div class="row mb-4">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ $accreditation_doc->agency->agency_code }} - {{ $accreditation_doc->program->program_code }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                @if ($accreditation_doc->progress != 'completed' && $accreditation_doc->type == 'reaccredit')
                                <a href="{{ route('answer.show.recommendation', $accreditation_doc) }}" class="btn btn-primary btn-sm"><span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span> Answer Recommendation</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive doc_outline">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    
                                    <th scope="col">{{ __('Section') }}</th>
                                    <th scope="col">{{ __('Assigned To') }}</th>
                                    <!-- <th scope="col"></th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $outlines = buildTree($accreditation_doc->outlines);
                                @endphp
                                @foreach ($outlines as $outline)
                              
                                @if($outline->children)
                                <tr class="clickable-row parent_outline" data-toggle="collapse" id="row{{$outline->id}}" data-target=".row{{$outline->id}}" style="cursor: pointer;">
                                        
                                        <td><a href="{{ route('document-outline.edit', $outline) }}">{{ $outline->section }}</a></td>
                                        <td>{{ $outline->doc_type }}</td>
                                        <!-- <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="{{ route('document-outline.edit', $outline) }}">{{ __('Edit') }}</a>
                                                </div>
                                            </div>
                                        </td> -->
                                    
                                    </tr>
                                    
                                    @foreach($outline->children as $child)
                                    <tr class="collapse row{{$outline->id}} child" id="row{{$outline->id}}">
                                        
                                        <td><a href="{{ route('document-outline.edit', $child) }}">{{$child->section}}</a></td>
                                        <td>{{$outline->doc_type }}</td>
                                        <!-- <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="{{ route('document-outline.edit', $outline) }}">{{ __('Edit') }}</a>
                                                </div>
                                            </div>
                                        </td> -->
                                    
                                    </tr>
                                    @endforeach
                                @endif
                                    <!-- <tr class="clickable-row" data-toggle="collapse" id="row{{$outline->id}}" data-target=".row{{$outline->id}}">
                                        <td>
                                        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample{{$outline->id}}" role="button" aria-expanded="false" aria-controls="collapseExample{{$outline->id}}">
                                            Link with href
                                        </a>
                                        {{ $accreditation_doc->document->document_name }} --- {{$outline->id}}</td>
                                        <td>{{ $outline->section }} --- {{$outline->root_parent_id}}  </td>
                                        <td>{{ $outline->doc_type }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="{{ route('document-outline.edit', $outline) }}">{{ __('Edit') }}</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @if($outline->children)
                                    
                                        <tr class="clickable collapse row{{$outline->id}}" data-toggle="collapse" id="row{{$outline->id}}" data-target=".row{{$outline->id}}">
                                        <td><i class="glyphicon glyphicon-plus"></i></td>
                                        <td>Supplier2</td>
                                        <td>Supplier2</td>
                                        <td>Supplier2</td>
                                    
                                    </tr>
                                    @endif -->
                                
                                @endforeach

                                <!-- @foreach ($accreditation_doc->outlines as $doc)
                                
                                @if($doc->root_parent_id == $doc->parent_id)
                                    <tr class="clickable-row" data-toggle="collapse" id="row{{$doc->id}}" data-target=".row{{$doc->id}}">
                                        <td>
                                        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample{{$doc->id}}" role="button" aria-expanded="false" aria-controls="collapseExample{{$doc->id}}">
                                            Link with href {{$doc->id}}
                                        </a>
                                        {{ $accreditation_doc->document->document_name }} --- {{$doc->id}}</td>
                                        <td>{{ $doc->section }} --- {{$doc->root_parent_id}}  @if($doc->root_parent_id == 328) --- derald pogi @endif</td>
                                        <td>{{ $doc->doc_type }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="{{ route('document-outline.edit', $doc) }}">{{ __('Edit') }}</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                        <tr class="clickable collapse row{{$doc->id}}" data-toggle="collapse" id="row{{$doc->id}}" data-target=".row{{$doc->id}}">
                                        <td><i class="glyphicon glyphicon-plus"></i></td>
                                        <td>Supplier2</td>
                                        <td>Supplier2</td>
                                        <td>Supplier2</td>
                                    
                                    </tr>
                                    
                                @endif
                                @endforeach -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @include('layouts.footers.auth')
    </div>
@endsection