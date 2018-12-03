@extends('principal')
@section('contenido')
<template v-if="menu=0">
        <example-component></example-component>
</template>
<template v-if="menu=10">
        <h1></h1>
</template>

@endsection
