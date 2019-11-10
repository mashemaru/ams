<?php

function renderDocumentSections($sections, $scores) {
    return view('document.partials.sections', ['sections' => $sections, 'scores' => $scores]);
}

function getPermissions()
{
    return ['program', 'agency', 'user', 'accreditation', 'course', 'document', 'document-outline', 'scoring-type', 'team', 'timeline', 'role-permission'];
}