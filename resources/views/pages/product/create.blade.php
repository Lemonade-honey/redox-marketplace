@extends('layouts.app')

@section('body')
    <header>
        <x-main-header title="Create New Product" />
        <x-breadcrumb :datas="$bread" last="Create Product"/>
    </header>

    @include('includes.alert')

    <form method="POST" class="">
        @csrf
        <div class="p-4 w-full border border-gray-100 shadow rounded-lg h-min mt-10">
            <h2 class="text-xl sm:text-2xl font-semibold mb-4">General</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div class="">
                    <x-basic-label for="name" title="Images Product" />
                    <input type="file" id="file" multiple>
                </div>
                <div class="">
                    <div class="mb-5">
                        <x-basic-label for="name" title="Product Name" />
                        <x-basic-input type="text" id="name" name="name" value="" required />
                    </div>
                    <div class="mb-5">
                        <x-basic-label for="categorie" title="Product Categorie" />
                        <select name="categorie" id="categorie" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            @foreach ($categories as $item)
                            <option value="{{ $item->id }}" @selected(old('categorie') == $item->id)>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-5">
                        <x-basic-label for="Price" title="Price" />
                        <x-basic-input type="number" id="Price" name="price" value="{{ old('price') }}" />
                    </div>
                    <div class="mb-5">
                        <x-basic-label for="address" title="Description" />
                        <div class="w-full">
                            <textarea name="description" id="editor"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <h2 class="text-xl sm:text-2xl font-semibold my-4">Configuration</h2>
            <div class="">
                <div class="flex gap-2 max-w-sm">
                    <input type="text" name="key" id="keys" placeholder="key" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                    <button type="button" id="btnTambahKey" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-1 text-center">Tambah</button>
                </div>

                <div class="container"></div>
            </div>

            <div class="flex justify-end mt-10">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center" id="btn-submit">Create</button>
            </div>
        </div>
    </form>
@endsection

@push('style')
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet"/>
<style>
    .filepond--credits{
        display: none;
    }
    .filepond--root .filepond--drop-label {
        height: 200px;
    }.ck-editor__editable_inline > ol, ul{
        padding-left: 1rem;
    }
</style>
@endpush

@push('script')
<script src="{{ asset('js/domElement.js') }}"></script>
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>

<script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/super-build/ckeditor.js"></script>
<script>
    CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
        // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
        toolbar: {
            items: [
                'undo', 'redo', '|',
                'heading', '|',
                'bold', 'italic', 'strikethrough', 'underline', 'subscript', 'superscript', 'removeFormat', '|',
                'bulletedList', 'numberedList', 'todoList', '|',
                'outdent', 'indent', '|',
                'findAndReplace', 'selectAll', '|',
                '-',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                'alignment', '|',
                'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', '|',
                'horizontalLine', '|',
                'sourceEditing'
            ],
            shouldNotGroupWhenFull: false
        },
        // Changing the language of the interface requires loading the language file using the <script> tag.
        // language: 'es',
        list: {
            properties: {
                styles: true,
                startIndex: true,
                reversed: true
            }
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
            ]
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
        placeholder: 'Start Here!',
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
        fontFamily: {
            options: [
                'default',
                'Arial, Helvetica, sans-serif',
                'Courier New, Courier, monospace',
                'Georgia, serif',
                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                'Tahoma, Geneva, sans-serif',
                'Times New Roman, Times, serif',
                'Trebuchet MS, Helvetica, sans-serif',
                'Verdana, Geneva, sans-serif'
            ],
            supportAllValues: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
        fontSize: {
            options: [ 10, 12, 14, 'default', 18, 20, 22 ],
            supportAllValues: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
        link: {
            decorators: {
                addTargetToExternalLinks: true,
                defaultProtocol: 'https://',
                toggleDownloadable: {
                    mode: 'manual',
                    label: 'Downloadable',
                    attributes: {
                        download: 'file'
                    }
                }
            }
        },
        // The "super-build" contains more premium features that require additional configuration, disable them below.
        // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
        removePlugins: [
            // These two are commercial, but you can try them out without registering to a trial.
            // 'ExportPdf',
            // 'ExportWord',
            // 'CKBox',
            'CKFinder',
            'EasyImage',
            // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
            // Storing images as Base64 is usually a very bad idea.
            // Replace it on production website with other solutions:
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
            'Base64UploadAdapter',
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
            // from a local file system (file://) - load this site via HTTP server if you enable MathType.
            'MathType',
            // The following features are part of the Productivity Pack and require additional license.
            'SlashCommand',
            'Template',
            'DocumentOutline',
            'FormatPainter',
            'TableOfContents'
        ]
    }).catch(error => {
        console.error( error );
    });
</script>

<script>
    const btnTambahKey = document.getElementById("btnTambahKey")
    const target = document.querySelector('.container')
    btnTambahKey.addEventListener("click", () => {
        let keyValue = document.getElementById("keys").value
        if(keyValue){
            console.log(keyValue.toLowerCase());
            
            let container = ml('div', {class:"mt-10"}, [
                ml('div', {class:"text-lg font-medium"}, `${keyValue}`),
                ml('div', {class:"my-4", id:`target-${keyValue}`})
            ])

            const btnDelete = document.createElement('button')
            btnDelete.setAttribute('class', 'focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-1 me-2 mb-2')
            btnDelete.innerHTML = 'Hapus Config'
            btnDelete.setAttribute("type", "button")
            btnDelete.addEventListener('click', () => {
                btnDelete.parentElement.remove()
            })
            container.append(btnDelete)

            const btnTambah = document.createElement('button')
            btnTambah.innerHTML = 'Tambah nilai'
            btnTambah.setAttribute('class', 'focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-1 me-2 mb-2')
            btnTambah.setAttribute("type", "button")
            btnTambah.addEventListener('click', () => {
                let subContainer = ml('div', {}, [
                    ml('input', {type:"text", name:`configs[${keyValue}][]`, class:"block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500", id:"configs"})
                ])

                const targetSub = document.getElementById(`target-${keyValue}`)
                targetSub.append(subContainer)

                const btnDeleteSub = document.createElement('button')
                btnDeleteSub.innerHTML = 'delete sub'
                btnDeleteSub.setAttribute('class', 'focus:outline-none text-white bg-yellow-500 hover:bg-yellow-700 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-1 me-2 mb-2')
                btnDeleteSub.setAttribute("type", "button")
                btnDeleteSub.addEventListener('click', () => {
                    btnDeleteSub.parentElement.remove()
                })
                subContainer.append(btnDeleteSub)

                let inputConfigs = document.querySelectorAll("#configs")

                inputConfigs.forEach(e => {
                    e.required = true;
                });
                
            })
            container.append(btnTambah)

            // append to container
            target.append(container)

            document.getElementById("keys").value = ''
        }
    })
</script>

<script>
    const inputElement = document.getElementById('file');
    const btnSubmit = document.getElementById('btn-submit')
    // Register the plugin
    FilePond.registerPlugin(FilePondPluginFileValidateType, FilePondPluginImagePreview);

    FilePond.create(inputElement, {
        acceptedFileTypes: ['image/*'],
        name: "files[]",
        required: true,
        onprocessfilestart: (file) => {
            console.log('file been process', btnSubmit);
            btnSubmit.disabled = true;
        },
        onprocessfilerevert: (file) => {
            console.log('file been revert', btnSubmit);
            btnSubmit.disabled = true;
        },
        onprocessfile: (error, file) => {
            console.log('file selesai di proses', error, file);
            btnSubmit.disabled = false;
        },
        onremovefile: (error, file) => {
            console.log(error);
            btnSubmit.disabled = false;
        },
        server: {
            process: {
                url: "{{ route('files.upload') }}",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Accept' : 'application/json',
                }
            },
            revert:{
                url: "{{ route('files.revert') }}",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Accept' : 'application/json',
                }
            }
        }
    })
</script>
@endpush