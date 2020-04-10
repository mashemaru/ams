<?php

function renderDocumentSections($sections, $scores) {
    return view('document.partials.sections', ['sections' => $sections, 'scores' => $scores]);
}


function renderViewDocumentSections($sections) {
    return view('document.partials.show', ['sections' => $sections]);
}

function getPermissions()
{
    return ['program', 'agency', 'user', 'accreditation', 'course', 'document', 'document-outline', 'scoring-type', 'curriculum', 'faculty', 'team', 'timeline', 'role-permission'];
}