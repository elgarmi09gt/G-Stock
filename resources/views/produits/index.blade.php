@extends('layouts\dashbord')
@section('content')
    <table>
            <tr>
                <th>Refrence</th>
                <th>Libelle</th>
                <th>Active</th>
            </tr>
            @forelse ($produits as $produit)
            <tr>
                <td>{{ $produit->reference }}</td>
                <td>{{ $produit->libelle }}</td>
                <td>{{ $produit->active }}</td>
            </tr>
            @empty
            <h3>Pas de produit</h3>
            @endforelse
    </table>
{{ $produits->links() }}
@endsection
@section('title', 'List produits')
