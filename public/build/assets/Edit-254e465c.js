import{K as h,T as y,f as d,a as o,u as s,w as n,F as x,o as p,Z as v,i as w,d as m,b as t,t as f,g as _,e as V,k,v as $,n as D}from"./app-0ba96f67.js";import{_ as N}from"./AuthenticatedLayout-5950db32.js";import{_ as c,a as g,b as u}from"./TextInput-28259f1b.js";import{P}from"./PrimaryButton-0963ab00.js";import"./ApplicationLogo-0dc88f3c.js";const B=t("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"},"Editar proyecto",-1),E={key:0,class:"bg-red-500 p-4 rounded-lg text-white m-4"},C={class:"text-lg"},F={key:1,class:"bg-green-500 p-4 rounded-lg text-white m-4"},S={class:"text-lg"},T={class:"py-12"},U={class:"max-w-7xl mx-auto sm:px-6 lg:px-8"},M=["onSubmit"],j={class:"mt-4"},z={class:"mt-4"},A={class:"flex items-center justify-end mt-4"},J={__name:"Edit",setup(K){const{proyecto:l}=h().props,e=y({nombre:l.nombre,descripcion:l.descripcion,presupuesto:l.presupuesto}),b=()=>{const r=new FormData;r.append("nombre",e.nombre),r.append("descripcion",e.descripcion),r.append("presupuesto",e.presupuesto),e.post(route("proyecto.update",{id:l.id}),{data:r})};return(r,a)=>(p(),d(x,null,[o(s(v),{title:"Dashboard"}),o(N,null,{header:n(()=>[B,o(s(w),{href:r.route("proyecto.show",{id:s(l).id}),class:"font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 m-8 mt-8"},{default:n(()=>[m("Atrás")]),_:1},8,["href"])]),default:n(()=>[r.$page.props.flash.error?(p(),d("div",E,[t("p",C,f(r.$page.props.flash.error),1)])):_("",!0),r.$page.props.flash.success?(p(),d("div",F,[t("p",S,f(r.$page.props.flash.success),1)])):_("",!0),t("div",T,[t("div",U,[t("form",{onSubmit:V(b,["prevent"]),enctype:"multipart/form-data"},[t("div",null,[o(c,{for:"nombre",value:"Nombre del Proyecto"}),o(g,{id:"nombre",type:"text",class:"mt-1 block w-full",modelValue:s(e).nombre,"onUpdate:modelValue":a[0]||(a[0]=i=>s(e).nombre=i),autofocus:"",autocomplete:"nombre"},null,8,["modelValue"]),o(u,{class:"mt-2",message:s(e).errors.nombre},null,8,["message"])]),t("div",j,[o(c,{for:"descripcion",value:"Descripcion del Proyecto"}),k(t("textarea",{name:"descripcion",id:"descripcion",cols:"60",rows:"10","onUpdate:modelValue":a[1]||(a[1]=i=>s(e).descripcion=i)},null,512),[[$,s(e).descripcion]]),o(u,{class:"mt-2",message:s(e).errors.descripcion},null,8,["message"])]),t("div",z,[o(c,{for:"presupuesto",value:"Presupuesto"}),o(g,{id:"presupuesto",type:"number",class:"mt-1 block w-full",modelValue:s(e).presupuesto,"onUpdate:modelValue":a[2]||(a[2]=i=>s(e).presupuesto=i),autocomplete:"new-password"},null,8,["modelValue"]),o(u,{class:"mt-2",message:s(e).errors.presupuesto},null,8,["message"])]),t("div",A,[o(P,{class:D(["ml-4",{"opacity-25":s(e).processing}]),disabled:s(e).processing},{default:n(()=>[m(" Editar! ")]),_:1},8,["class","disabled"])])],40,M)])])]),_:1})],64))}};export{J as default};