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
                                    <th scope="col" width="25">{{ __('Document Type') }}</th>
                                    <!-- <th scope="col">{{ __('Assigned To') }}</th> -->
                                    <!-- <th scope="col"></th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                //echo '<pre>';
                                    $outlines = buildTree($accreditation_doc->outlines);
                                    //print_r($outlines);
                                    //die();
                                @endphp
                                @foreach ($outlines as $outline)
                                    <tr class="root_parent row{{$outline->parent_id}} parent_outline collapsed" data-toggle="collapse" id="row{{$outline->id}}" data-target=".row{{$outline->id}}" style="cursor: pointer;">
                                        <td><a href="{{ route('document-outline.edit', $outline) }}">{{ $outline->section }}</a></td>
                                        <td>{{ $outline->doc_type }}</td>
                                    </tr>
                                    @if($outline->children)
                                        @foreach ( $outline->children as $child )
                                            <tr class="collapse row{{$child->parent_id}} {{($child->children) ? 'parent_outline' : ''}} child1" data-toggle="collapse" id="row{{$child->id}}" data-target=".row{{$child->id}}" data-parent="#row{{$outline->id}}">
                                                <td><a href="{{ route('document-outline.edit', $child) }}">{{$child->section}}</a></td>
                                                <td>{{$outline->doc_type }}</td>
                                            </tr>
                                            @if($child->children)
                                                @foreach($child->children as $children)
                                                <tr class="collapse row{{$children->parent_id}} {{($children->children) ? 'parent_outline' : ''}} child2" data-toggle="collapse" id="row{{$children->id}}" data-target=".row{{$children->id}}" data-parent="#row{{$child->id}}">
                                                    <td><a href="{{ route('document-outline.edit', $children) }}">{{$children->section}}</a></td>
                                                    <td>{{$children->doc_type }}</td>
                                                </tr>
                                                @if($children->children)
                                                    @foreach($children->children as $children2)
                                                    <tr class="collapse row{{$children2->parent_id}} {{($children2->children) ? 'parent_outline' : ''}} child3" data-toggle="collapse" id="row{{$children2->id}}" data-target=".row{{$children2->id}}" data-parent="#row{{$children->id}}">
                                                        
                                                        <td><a href="{{ route('document-outline.edit', $children2) }}">{{$children2->section}}</a></td>
                                                        <td>{{$children2->doc_type }}</td>
                                                    </tr>
                                                    @if($children2->children)
                                                        @foreach($children2->children as $children3)
                                                        <tr class="collapse row{{$children3->parent_id}} child4" id="row{{$children3->id}}" data-parent="#row{{$children2->id}}">
                                                            <td><a href="{{ route('document-outline.edit', $children3) }}">{{$children3->section}}</a></td>
                                                            <td>{{$children2->doc_type }}</td>
                                                        </tr>
                                                        @endforeach
                                                    @endif
                                                    @endforeach
                                                @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                
                                @endforeach

                               
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
