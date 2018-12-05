@extends('principal')
@section('contenido')

    <!-- <especialidad></especialidad> -->
	<!--<signosvitales></signosvitales>-->
	<!--<medicamento></medicamento>-->
	<template v-if="menu==0">
    <h1>esyo es el menu 0</h1>
    </template>

    <template v-if="menu==1">
    <medicamento></medicamento>
    </template>

    <template v-if="menu==2">
    <servicios></servicios>
    </template>

    <template v-if="menu==3">
    <profesionalenmedicina></profesionalenmedicina>
    </template>

    <template v-if="menu==3">
    <tratamiento></tratamiento>
    </template>
	<!-- <servicio></servicio> -->
	<!-- <profesionalenmedicina></profesionalenmedicina> -->
	<!-- <consulta></consulta> -->
	<!-- <examenmatenimiento></examenmatenimiento> -->
	<!-- <horariosclinica></horariosclinica> -->
	<!-- <receta></receta> -->
	<!-- <horariospuesto></horariospuesto> -->
	@endsection
