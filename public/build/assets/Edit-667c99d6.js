import{K as g,T as b,f as i,a,u as s,w as u,F as m,o as l,Z as x,b as e,t as n,g as p,k as v,e as y,n as _,d as w,j as $}from"./app-3cf83bfd.js";import{_ as k}from"./AuthenticatedLayout-55372edd.js";import{_ as V,a as M,b as N}from"./TextInput-1cc90bbb.js";import{P as B}from"./PrimaryButton-f508bfeb.js";import"./ApplicationLogo-f90f9a13.js";const E={class:"font-semibold text-xl text-gray-800 leading-tight"},j={key:0,class:"bg-red-500 p-4 rounded-lg text-white m-4"},C={class:"text-lg"},F={key:1,class:"bg-green-500 p-4 rounded-lg text-white m-4"},H={class:"text-lg"},S={class:"py-12"},U={class:"max-w-7xl mx-auto sm:px-6 lg:px-8"},D=["onMouseenter","onMouseleave"],P={class:"text-lg font-semibold mb-4"},T={class:"text-lg font-semibold mb-4"},z=e("button",{class:"text-blue-500"},"Gestionar",-1),A={class:"max-w-7xl mx-auto sm:px-6 lg:px-8"},G=["onSubmit"],K={class:"flex items-center justify-end mt-4"},Q={__name:"Edit",setup(L){const{proyecto:d}=g().props,o=b({usuario:""}),f=()=>{o.post(route("proyecto.add.usuario",{id:d.id}),{onFinish:()=>o.reset("usuario")})};return(r,c)=>(l(),i(m,null,[a(s(x),{title:"Dashboard"}),a(k,null,{header:u(()=>[e("h2",E," Edita Usuarios en "+n(s(d).nombre),1)]),default:u(()=>[r.$page.props.flash.error?(l(),i("div",j,[e("p",C,n(r.$page.props.flash.error),1)])):p("",!0),r.$page.props.flash.success?(l(),i("div",F,[e("p",H,n(r.$page.props.flash.success),1)])):p("",!0),e("div",S,[e("div",U,[(l(!0),i(m,null,v(s(d).usuarios,t=>(l(),i("div",{key:t.id,class:_(["bg-white shadow-md rounded-md p-4 cursor-pointer transition-transform duration-300 transform hover:scale-105 flex items-center justify-between",{"bg-gray-100":t.isHovered}]),onMouseenter:h=>t.isHovered=!0,onMouseleave:h=>t.isHovered=!1},[e("div",P,n(t.user.name),1),e("div",T,n(t.user.email),1),a(s($),{href:r.route("proyecto.usuarios.edit",{id:s(d).id,usuario:t.id})},{default:u(()=>[z]),_:2},1032,["href"])],42,D))),128))]),e("div",A,[e("form",{onSubmit:y(f,["prevent"])},[e("div",null,[a(V,{for:"usuario",value:"Nuevo Usuario"}),a(M,{id:"usuario",type:"text",class:"mt-1 block w-full",modelValue:s(o).usuario,"onUpdate:modelValue":c[0]||(c[0]=t=>s(o).usuario=t),placeholder:"Email del usuario",autofocus:"",autocomplete:"usuario"},null,8,["modelValue"]),a(N,{class:"mt-2",message:s(o).errors.usuario},null,8,["message"])]),e("div",K,[a(B,{class:_(["ml-4",{"opacity-25":s(o).processing}]),disabled:s(o).processing},{default:u(()=>[w(" Añadir usuario! ")]),_:1},8,["class","disabled"])])],40,G)])])]),_:1})],64))}};export{Q as default};