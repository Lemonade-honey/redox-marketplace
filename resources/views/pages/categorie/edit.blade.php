@extends('layouts.app')

@section('body')
<header>
    <x-main-header title="Edit Categorie" />
    <x-breadcrumb :datas="$berd" last="Edit Categorie" />
</header>

@include('includes.alert')

<section class="my-5">
    <div class="p-4 w-full border border-gray-100 shadow rounded-lg">
        <form method="post">
            @csrf
            <div class="mb-5">
                <x-basic-label for="name" title="Categorie Name" />
                <x-basic-input type="text" id="name" name="name" value="{{ old('name', $categorie->name) }}" required />
            </div>
            <div class="flex justify-end mt-10">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center" id="btn-submit">Update</button>
            </div>
        </form>
    </div>

    <div class="p-4 w-full border border-gray-100 shadow rounded-lg h-min mt-10">
        <h2 class="text-xl sm:text-2xl text-red-500 font-semibold mb-4">Delete Product</h2>
        <p class="text-sm">Categorie akan dihapus secara permanen</p>
        <div class="flex justify-center mt-5">
            <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center" id="btn-delete">DELETE</button>
        </div>
    </div>
</section>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById("btn-delete").addEventListener("click", () => {
        const random = Math.floor(Math.random() * 1000)

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "{{ route('master.categorie.delete', $categorie->id) }}"
            }
        })
    })
</script>
@endpush