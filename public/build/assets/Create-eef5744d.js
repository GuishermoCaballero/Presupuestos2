import{T as d,o as u,f as p,a as o,u as s,w as r,F as _,Z as f,b as a,e as g,i as b,B as x,n as v,d as y}from"./app-1c97fc39.js";import{_ as w}from"./AuthenticatedLayout-9b375413.js";import{_ as i,a as m,b as n}from"./TextInput-3793c85e.js";import{P as V}from"./PrimaryButton-83d4fc6f.js";import"./ApplicationLogo-1fe235dd.js";import"./_plugin-vue_export-helper-c27b6911.js";const h=a("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"},"Crea un proyecto!",-1),B={class:"py-12"},C={class:"max-w-7xl mx-auto sm:px-6 lg:px-8"},k=["onSubmit"],N={class:"mt-4"},P={class:"mt-4"},$={class:"flex items-center justify-end mt-4"},E={__name:"Create",setup(D){const e=d({nombre:"",descripcion:"",imagen_url:""}),c=()=>{e.post(route("proyecto.save"))};return(T,t)=>(u(),p(_,null,[o(s(f),{title:"Dashboard"}),o(w,null,{header:r(()=>[h]),default:r(()=>[a("div",B,[a("div",C,[a("form",{onSubmit:g(c,["prevent"])},[a("div",null,[o(i,{for:"nombre",value:"Nombre del Proyecto"}),o(m,{id:"nombre",type:"text",class:"mt-1 block w-full",modelValue:s(e).nombre,"onUpdate:modelValue":t[0]||(t[0]=l=>s(e).nombre=l),autofocus:"",autocomplete:"nombre"},null,8,["modelValue"]),o(n,{class:"mt-2",message:s(e).errors.nombre},null,8,["message"])]),a("div",N,[o(i,{for:"descripcion",value:"Descripcion del Proyecto"}),b(a("textarea",{name:"descripcion",id:"descripcion",cols:"60",rows:"10","onUpdate:modelValue":t[1]||(t[1]=l=>s(e).descripcion=l)},null,512),[[x,s(e).descripcion]]),o(n,{class:"mt-2",message:s(e).errors.descripcion},null,8,["message"])]),a("div",P,[o(i,{for:"imagen_url",value:"Imagen"}),o(m,{id:"imagen_url",type:"file",class:"mt-1 block w-full",modelValue:s(e).imagen_url,"onUpdate:modelValue":t[2]||(t[2]=l=>s(e).imagen_url=l),autocomplete:"new-password"},null,8,["modelValue"]),o(n,{class:"mt-2",message:s(e).errors.imagen_url},null,8,["message"])]),a("div",$,[o(V,{class:v(["ml-4",{"opacity-25":s(e).processing}]),disabled:s(e).processing},{default:r(()=>[y(" Crear! ")]),_:1},8,["class","disabled"])])],40,k)])])]),_:1})],64))}};export{E as default};