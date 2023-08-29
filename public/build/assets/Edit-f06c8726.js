import{K as y,j as x,T as w,f as c,a as o,u as e,w as f,F as p,o as m,Z as V,b as a,t as u,i as k,d as b,g,e as $,k as v,v as q,B as U,l as A,n as S}from"./app-0ba96f67.js";import{_ as B}from"./AuthenticatedLayout-5950db32.js";import{_ as D}from"./Checkbox-298b217b.js";import{_ as r,a as _,b as d}from"./TextInput-28259f1b.js";import{P as N}from"./PrimaryButton-0963ab00.js";import"./ApplicationLogo-0dc88f3c.js";const C={class:"font-semibold text-xl text-gray-800 leading-tight"},F={key:0,class:"bg-red-500 p-4 rounded-lg text-white m-4"},j={class:"text-lg"},I={key:1,class:"bg-green-500 p-4 rounded-lg text-white m-4"},M={class:"text-lg"},T={class:"py-12 bg-gray-300"},z={class:"bg-gray-100 flex items-center justify-center"},E={class:"bg-white rounded-lg shadow-md p-6 w-96"},O={class:"mt-6"},P=["onSubmit"],K={class:"mb-2"},L={class:"mb-2"},Q={class:"mb-2"},Z={class:"mb-2"},G={class:"block my-4"},H={class:"flex items-center"},J=a("span",{class:"ml-2 text-sm text-gray-600"},"Añadir IVA",-1),R={class:"mb-2"},W=["value"],X=["value"],Y={class:"mb-2"},ee={class:"flex items-center justify-end mt-4"},se=a("div",{class:"max-w-7xl mx-auto sm:px-6 lg:px-8"},null,-1),ne={__name:"Edit",setup(ae){const{proyecto:i}=y().props;x("cambio");const s=w({factura_id:"",nombre:"",observacion:"",form:"cambio",etiqueta:"",cantidad:"",anadir_iva:!1,quien:[],fecha:new Date().toISOString().substr(0,10)}),h=()=>{s.post(route("proyecto.save.cantidad",{id:i.id}))};return(n,l)=>(m(),c(p,null,[o(e(V),{title:"Dashboard"}),o(B,null,{header:f(()=>[a("h2",C," Añadir gasto en "+u(e(i).nombre),1),o(e(k),{href:n.route("proyecto.show",{id:e(i).id}),class:"font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 m-8 mt-8"},{default:f(()=>[b("Atrás")]),_:1},8,["href"])]),default:f(()=>[n.$page.props.flash.error?(m(),c("div",F,[a("p",j,u(n.$page.props.flash.error),1)])):g("",!0),n.$page.props.flash.success?(m(),c("div",I,[a("p",M,u(n.$page.props.flash.success),1)])):g("",!0),a("div",T,[a("div",z,[a("div",E,[a("div",O,[a("form",{onSubmit:$(h,["prevent"])},[a("div",K,[o(r,{for:"factura_id",value:"Factura ID"}),o(_,{id:"factura_id",type:"text",class:"mt-1 block w-full",modelValue:e(s).factura_id,"onUpdate:modelValue":l[0]||(l[0]=t=>e(s).factura_id=t),autofocus:"",autocomplete:"factura_id"},null,8,["modelValue"]),o(d,{class:"mt-2",message:e(s).errors.factura_id},null,8,["message"])]),a("div",L,[o(r,{for:"nombre",value:"Nombre*"}),o(_,{id:"nombre",type:"text",class:"mt-1 block w-full",modelValue:e(s).nombre,"onUpdate:modelValue":l[1]||(l[1]=t=>e(s).nombre=t),autofocus:"",autocomplete:"nombre"},null,8,["modelValue"]),o(d,{class:"mt-2",message:e(s).errors.nombre},null,8,["message"])]),a("div",Q,[o(r,{for:"observacion",value:"Observacion"}),v(a("textarea",{name:"observacion",id:"observacion",cols:"35",rows:"10","onUpdate:modelValue":l[2]||(l[2]=t=>e(s).observacion=t)},null,512),[[q,e(s).observacion]]),o(d,{class:"mt-2",message:e(s).errors.observacion},null,8,["message"])]),a("div",Z,[o(r,{for:"cantidad",value:"Cantidad*"}),o(_,{id:"cantidad",type:"number",class:"mt-1 block w-full",modelValue:e(s).cantidad,"onUpdate:modelValue":l[3]||(l[3]=t=>e(s).cantidad=t),autofocus:"",autocomplete:"cantidad"},null,8,["modelValue"]),o(d,{class:"mt-2",message:e(s).errors.cantidad},null,8,["message"])]),a("div",G,[a("label",H,[o(D,{name:"anadir_iva",checked:e(s).anadir_iva,"onUpdate:checked":l[4]||(l[4]=t=>e(s).anadir_iva=t)},null,8,["checked"]),J])]),a("div",R,[o(r,{for:"quien",value:"Quien realiza el movimiento*"}),v(a("select",{class:"w-full px-4 py-2 border border-gray-300 rounded-md text-gray-900 focus:outline-none focus:ring focus:ring-indigo-200","onUpdate:modelValue":l[5]||(l[5]=t=>e(s).quien=t),multiple:""},[a("option",{value:e(i).user.id},u(e(i).user.name)+" (Administrador) ",9,W),(m(!0),c(p,null,A(e(i).usuarios,t=>(m(),c("option",{key:t.id,value:t.user.id},u(t.user.name),9,X))),128))],512),[[U,e(s).quien]]),o(d,{class:"mt-2",message:e(s).errors.quien},null,8,["message"])]),a("div",Y,[o(r,{for:"quien",value:"Fecha del movimiento*"}),o(_,{id:"cantidad",type:"date",class:"mt-1 block w-full",modelValue:e(s).fecha,"onUpdate:modelValue":l[6]||(l[6]=t=>e(s).fecha=t),autofocus:"",autocomplete:"cantidad"},null,8,["modelValue"]),o(d,{class:"mt-2",message:e(s).errors.fecha},null,8,["message"])]),a("div",ee,[o(N,{class:S(["ml-4",{"opacity-25":e(s).processing}]),disabled:e(s).processing},{default:f(()=>[b(" Añadir gasto ")]),_:1},8,["class","disabled"])])],40,P)])])]),se])]),_:1})],64))}};export{ne as default};
