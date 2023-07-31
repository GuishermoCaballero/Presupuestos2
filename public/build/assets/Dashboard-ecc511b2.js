import{_ as u}from"./AuthenticatedLayout-5dddfae5.js";import{K as h,f as s,a as o,u as r,w as a,F as i,o as d,Z as m,j as _,d as f,b as e,k as p,t as c}from"./app-26c4e039.js";import"./ApplicationLogo-d51fb21c.js";const g=e("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"},"Proyectos:",-1),x={class:"py-12"},b={class:"max-w-7xl mx-auto sm:px-6 lg:px-8"},y={class:"grid grid-cols-3 gap-4"},w=["href"],v={class:"text-lg font-semibold mb-2"},k={class:"text-gray-600 mb-4"},B=["src"],F={__name:"Dashboard",setup(D){const{proyectos:l}=h().props;return(n,N)=>(d(),s(i,null,[o(r(m),{title:"Dashboard"}),o(u,null,{header:a(()=>[g]),default:a(()=>[o(r(_),{href:n.route("proyecto.create"),class:"font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"},{default:a(()=>[f("Crear un proyecto")]),_:1},8,["href"]),e("div",x,[e("div",b,[e("div",y,[(d(!0),s(i,null,p(r(l),t=>(d(),s("a",{key:t.id,href:n.route("proyecto.show",{id:t.id}),class:"bg-white shadow-md rounded-md p-4 cursor-pointer transition-transform duration-300 transform hover:scale-105"},[e("h3",v,c(t.nombre),1),e("p",k,c(t.descripcion),1),e("img",{src:t.imagen_url,alt:"Imagen del proyecto",class:"w-full rounded-md h-40 object-cover"},null,8,B)],8,w))),128))])])])]),_:1})],64))}};export{F as default};