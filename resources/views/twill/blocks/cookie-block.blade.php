@twillBlockTitle('Cookie category')
@twillBlockGroup('twill-cookie-consent')

@php
    $wysiwygOptions = [
      ['header' => [3, 4, 5, 6, false]],
      'bold',
      'italic',
      'underline',
      'strike',
      ["script" => "super"],
      ["script" => "sub"],
      "blockquote",
      "code-block",
      ['list' => 'ordered'],
      ['list' => 'bullet'],
      ['indent' => '-1'],
      ['indent' => '+1'],
      'link',
      "clean",
    ];
@endphp

<x-twill::input
        name="cookie_category_name"
        label="Cookie name"
/>

<x-twill::input
    name="cookie_key"
    label="Cookie key"
/>

<x-twill::radios
        name="cookie_type"
        label="Cookie type (required/optional)"
        default="required"
        :inline="true"
        :options="[
        [
            'value' => 'required',
            'label' => 'Required'
        ],
        [
            'value' => 'optional',
            'label' => 'Optional'
        ]
    ]"
/>

<x-twill::wysiwyg
    name="cookie_category_text"
    label="Cookie category text"
    :toolbar-options="$wysiwygOptions"
    placeholder="A Description of the cookie category"
    :edit-source="true"
/>

<x-twill::repeater
    type="cookie"
/>