import{_ as h}from"./AuthenticatedLayout-348bc480.js";import{K as f,o as i,f as l,a,u as e,w as r,F as n,Z as p,b as t,t as o,k as x,j as u,d as m,D as g}from"./app-af4a6b9e.js";import"./ApplicationLogo-d39edf0e.js";import"./_plugin-vue_export-helper-c27b6911.js";const y={class:"font-semibold text-xl text-gray-800 leading-tight"},b={class:"py-12"},v={class:"max-w-7xl mx-auto sm:px-6 lg:px-8"},w={class:"max-w-3xl mx-auto"},k={class:"bg-white shadow-md rounded-md p-8"},E={class:"text-2xl font-semibold mb-4"},B={class:"text-gray-600 mb-6"},N=["src"],S={class:"label"},V={class:"progress-bar"},j={class:"percentage"},C={class:"m-8"},L={__name:"Show",setup(F){const{proyecto:s}=f().props;return(c,q)=>(i(),l(n,null,[a(e(p),{title:"Dashboard"}),a(h,null,{header:r(()=>[t("h2",y,o(e(s).nombre),1)]),default:r(()=>[t("div",b,[t("div",v,[t("div",w,[t("div",k,[t("h2",E,o(e(s).nombre),1),t("p",B,o(e(s).descripcion),1),t("img",{src:e(s).imagen_url,alt:"Imagen del proyecto",class:"w-full rounded-md h-60 object-cover mb-6"},null,8,N),(i(!0),l(n,null,x(e(s).totales,(d,_)=>(i(),l("div",{key:_,class:"row"},[t("div",S,o(d.etiqueta),1),t("div",V,[t("div",{class:"progress",style:g({width:d.cantidad+"%"})},null,4)]),t("div",j,o(d.cantidad)+"%",1)]))),128)),t("div",C,[a(e(u),{href:c.route("proyecto.etiquetas.edit",{id:e(s).id}),class:"font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 m-4 mt-8"},{default:r(()=>[m("Editar Etiquetas")]),_:1},8,["href"]),a(e(u),{href:c.route("proyecto.cantidades.edit",{id:e(s).id}),class:"font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 m-4 mt-8"},{default:r(()=>[m("Editar Cantidades")]),_:1},8,["href"])])])])])])]),_:1})],64))}};export{L as default};
