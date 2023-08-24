import{_ as g}from"./AuthenticatedLayout-fae811fe.js";import{K as f,D as w,f as a,a as i,u as e,w as c,F as u,o as d,Z as k,b as t,t as o,j as _,i as m,d as h,g as C,n as F}from"./app-f1039a18.js";import"./ApplicationLogo-7f5dba98.js";const D={class:"font-semibold text-xl text-gray-800 leading-tight"},G={class:"py-12"},A={class:"max-w-full mx-auto sm:px-6 lg:px-8"},U={class:"flex"},I={class:"bg-white shadow-md rounded-md p-8"},S={class:"text-2xl font-semibold mb-4"},V={class:"text-gray-600 mb-6"},$=["src"],E={class:"m-4 w-1/2"},N=t("h2",{class:"text-xl font-semibold mb-4"},"Gastos",-1),P={class:"m-4 w-1/2"},B=t("h2",{class:"text-xl font-semibold mb-4"},"Gastos por Usuario",-1),L={class:"m-4 mt-8 mb-8"},T=t("h2",{class:"text-xl font-semibold mb-4"},"Gastos por Usuario",-1),X={class:"overflow-x-auto"},j={class:"min-w-full border border-gray-200"},z={class:"bg-gray-100"},K=t("th",{class:"px-4 py-2"},"Factura Id",-1),M=t("th",{class:"px-4 py-2"},"Fecha",-1),R=t("th",{class:"px-4 py-2"},"Concepto",-1),Z=t("th",{class:"px-4 py-2"},"Importe",-1),q=t("th",{class:"px-4 py-2"},"IVA",-1),H=t("th",{class:"px-4 py-2"},"Importe Final",-1),J={class:"px-4 py-2"},O={class:"px-4 py-2"},Q=t("th",{class:"px-4 py-2"},"Editar Gasto",-1),W={class:"px-4 py-2"},Y={class:"px-4 py-2"},tt={class:"px-4 py-2"},et={class:"px-4 py-2"},st={class:"px-4 py-2"},ot={class:"px-4 py-2"},rt={class:"px-4 py-2"},at={class:"px-4 py-2"},dt={class:"px-4 py-2"},nt=t("br",null,null,-1),it={class:"label"},lt=t("br",null,null,-1),ct=t("hr",null,null,-1),ut=t("br",null,null,-1),_t={key:0,class:"m-8"},ht={class:"bg-white shadow-md rounded-md p-8 flex-1 mx-4 mb-4 overflow-auto max-h-50vh"},mt=t("h2",{class:"text-xl font-semibold mb-4"},"Usuarios Asignados",-1),pt={key:0},ft={key:1},xt={class:"bg-white shadow-md rounded-md p-8 flex-1 mx-4 mb-4 overflow-auto max-h-50vh"},bt=t("h2",{class:"text-xl font-semibold mb-4"},"Movimientos",-1),Ft={__name:"Show",setup(yt){const{proyecto:r,movimientos:x,usuario:b}=f().props;f().props;const y=l=>new Date(l).toLocaleDateString("en-US",{year:"numeric",month:"long",day:"numeric"});return(l,vt)=>{const p=w("GoogleChart");return d(),a(u,null,[i(e(k),{title:"Dashboard"}),i(g,null,{header:c(()=>[t("h2",D,o(e(r).nombre),1)]),default:c(()=>[t("div",G,[t("div",A,[t("div",null,[t("div",U,[t("div",I,[t("h2",S,o(e(r).nombre),1),t("p",V,o(e(r).descripcion),1),t("img",{src:e(r).imagen_url,alt:"Imagen del proyecto",class:"w-full rounded-md h-60 object-cover mb-6"},null,8,$),t("div",E,[N,i(p,{data:e(r).chart,type:"PieChart"},null,8,["data"])]),t("div",P,[B,i(p,{data:e(r).user_chart,type:"ColumnChart"},null,8,["data"])]),t("div",L,[T,t("div",X,[t("table",j,[t("thead",null,[t("tr",z,[K,M,R,Z,q,H,t("th",J,o(e(r).user.name),1),(d(!0),a(u,null,_(e(r).usuarios,(s,n)=>(d(),a("div",null,[t("th",O,o(s.user.name),1)]))),256)),Q])]),t("tbody",null,[(d(!0),a(u,null,_(e(r).gastos,(s,n)=>(d(),a("tr",{key:n,class:F(n%2===0?"bg-gray-50":"")},[t("td",W,o(s.id_factura),1),t("td",Y,o(y(s.created_at)),1),t("td",tt,o(s.nombre),1),t("td",et,o(s.cantidad),1),t("td",st,o(s.anadir_iva?"X":""),1),t("td",ot,o(s.cantidad_iva==0?s.cantidad:s.cantidad_iva),1),t("th",rt,o(s.usuarios_id.includes(e(r).user.id)?"X":""),1),(d(!0),a(u,null,_(e(r).usuarios,(v,gt)=>(d(),a("th",at,o(s.usuarios_id.includes(v.user.id)?"X":""),1))),256)),t("th",dt,[i(e(m),{href:l.route("proyecto.cantidades.update",{id:s.id}),class:"font-semibold text-gray-600 hover:text-green-900 dark:text-gray-400 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 m-4 mt-8 transition-colors duration-300 ease-in-out hover:border-b-2 border-transparent hover:border-green-900"},{default:c(()=>[h(" Editar ")]),_:2},1032,["href"])])],2))),128))])])])]),t("div",null,"Presupuesto: "+o(e(r).presupuesto.toFixed(2))+" $",1),nt,(d(!0),a(u,null,_(e(r).etiquetas,(s,n)=>(d(),a("div",{key:n,class:"row"},[t("div",it,o(s.etiqueta)+": "+o(s.cantidad.toFixed(2))+"$ - "+o((s.cantidad/e(r).presupuesto*100).toFixed(2))+"% ",1),lt,ct]))),128)),ut,t("div",null,"Total Gastado: "+o(e(r).gastado.toFixed(2))+" $",1),t("div",null,"Total Restante: "+o(e(r).restante.toFixed(2))+" $",1),e(b).is_admin?(d(),a("div",_t,[i(e(m),{href:l.route("proyecto.cantidades.edit",{id:e(r).id}),class:"font-semibold text-gray-600 hover:text-green-900 dark:text-gray-400 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 m-4 mt-8 transition-colors duration-300 ease-in-out hover:border-b-2 border-transparent hover:border-green-900"},{default:c(()=>[h(" Añadir gasto ")]),_:1},8,["href"]),i(e(m),{href:l.route("proyecto.usuarios.index",{id:e(r).id}),class:"font-semibold text-gray-600 hover:text-green-900 dark:text-gray-400 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 m-4 mt-8 transition-colors duration-300 ease-in-out hover:border-b-2 border-transparent hover:border-green-900"},{default:c(()=>[h(" Administrar Usuarios ")]),_:1},8,["href"]),i(e(m),{href:l.route("proyecto.edit",{id:e(r).id}),class:"font-semibold text-gray-600 hover:text-green-900 dark:text-gray-400 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 m-4 mt-8 transition-colors duration-300 ease-in-out hover:border-b-2 border-transparent hover:border-green-900"},{default:c(()=>[h(" Editar Proyecto ")]),_:1},8,["href"]),i(e(m),{href:l.route("proyecto.delete",{id:e(r).id}),method:"delete",as:"button",class:"inline-block bg-red-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-50 transition duration-300 ease-in-out m-4 mt-8"},{default:c(()=>[h(" Delete Proyecto ")]),_:1},8,["href"])])):C("",!0)]),t("div",null,[t("div",ht,[mt,t("ul",null,[t("li",null,o(e(r).user.name)+" - Administrador",1),(d(!0),a(u,null,_(e(r).usuarios,(s,n)=>(d(),a("li",{key:n},[h(o(s.user.name)+" - ",1),s.is_admin?(d(),a("span",pt," Administrador")):(d(),a("span",ft,"Usuario"))]))),128))])]),t("div",xt,[bt,t("ul",null,[(d(!0),a(u,null,_(e(x),(s,n)=>(d(),a("li",{key:n,class:"mb-4"},o(s.user.name)+" - "+o(s.valor)+" - "+o(new Date(s.created_at).toLocaleDateString()),1))),128))])])])])])])])]),_:1})],64)}}};export{Ft as default};
