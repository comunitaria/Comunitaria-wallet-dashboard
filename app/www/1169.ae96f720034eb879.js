"use strict";(self.webpackChunkapp=self.webpackChunkapp||[]).push([[1169],{1169:(y,C,i)=>{i.r(C),i.d(C,{InicioPageModule:()=>v});var d=i(177),u=i(4341),g=i(7863),f=i(8986),l=i(467),P=i(5312),e=i(4438),r=i(7291),n=i(8856);function t(o,h){if(1&o&&(e.j41(0,"ion-item",6),e.nrm(1,"ion-icon",7),e.EFF(2),e.k0s()),2&o){const p=h.$implicit;e.Y8G("routerLink",p.redirectTo),e.R7$(),e.Y8G("name",p.icon),e.R7$(),e.SpI(" ",p.name," ")}}const _=[{path:"",component:(()=>{var o;class h{constructor(a,m){this.disco=a,this.oCom=m,this.tiendas=[],this.componentes=[{icon:"american-football",name:"Action Sheet",redirectTo:"/action-sheet"},{icon:"alert-circle-outline",name:"Alertas",redirectTo:"/alert"},{icon:"log-in",name:"Login",redirectTo:"/login"},{icon:"person-add",name:"Registro",redirectTo:"/registro"},{icon:"home",name:"Comercios",redirectTo:"/tiendas"},{icon:"star",name:"Info de Stellar",redirectTo:"/stellar-info"},{icon:"card-outline",name:"Pagos",redirectTo:"/pagos"},{icon:"logo-ionic",name:"Principal",redirectTo:"/main"},{icon:"logo-ionic",name:"Pruebas",redirectTo:"/pruebas"}]}ngOnInit(){}guardarTiendas(){var a=this;return(0,l.A)(function*(){try{yield a.disco.borrarTiendas();let m=yield a.oCom.getTokenPromise(P.c.login,P.c.password);""!=m?a.oCom.getComercios(m).subscribe({next:I=>{console.log("Dentro de inicio comercios",I),a.tiendas=I.listado?I.listado:[];try{a.disco.guardarTiendas(a.tiendas)}catch(A){console.log("Error guardando en disco",A)}},error:I=>{console.log("Error recuperando comercios",I)}}):console.log("error recuperando token")}catch(m){console.log("Error borrando tiendas",m)}})()}leerTiendas(){this.disco.cargarTiendas().then(function(m){console.log("muestro tiendas",m)})}}return(o=h).\u0275fac=function(a){return new(a||o)(e.rXU(r.n),e.rXU(n.M))},o.\u0275cmp=e.VBU({type:o,selectors:[["app-inicio"]],decls:11,vars:3,consts:[[3,"translucent"],["color","primary"],[3,"fullscreen"],["detail","true",3,"routerLink",4,"ngFor","ngForOf"],["expand","block","fill","clear","shape","round",3,"click"],["expand","block",3,"click"],["detail","true",3,"routerLink"],["slot","start","color","primary",3,"name"]],template:function(a,m){1&a&&(e.j41(0,"ion-header",0)(1,"ion-toolbar")(2,"ion-title",1),e.EFF(3,"Inicio "),e.k0s()()(),e.j41(4,"ion-content",2)(5,"ion-list"),e.DNE(6,t,3,3,"ion-item",3),e.k0s(),e.j41(7,"ion-button",4),e.bIt("click",function(){return m.guardarTiendas()}),e.EFF(8," Generar comercios "),e.k0s(),e.j41(9,"ion-button",5),e.bIt("click",function(){return m.leerTiendas()}),e.EFF(10," Leer comercios "),e.k0s()()),2&a&&(e.Y8G("translucent",!0),e.R7$(4),e.Y8G("fullscreen",!0),e.R7$(2),e.Y8G("ngForOf",m.componentes))},dependencies:[d.Sq,g.Jm,g.W9,g.eU,g.iq,g.uz,g.nf,g.BC,g.ai,g.N7,f.Wk]}),h})()}];let T=(()=>{var o;class h{}return(o=h).\u0275fac=function(a){return new(a||o)},o.\u0275mod=e.$C({type:o}),o.\u0275inj=e.G2t({imports:[f.iI.forChild(_),f.iI]}),h})(),v=(()=>{var o;class h{}return(o=h).\u0275fac=function(a){return new(a||o)},o.\u0275mod=e.$C({type:o}),o.\u0275inj=e.G2t({imports:[d.MD,u.YN,g.bv,T]}),h})()},8856:(y,C,i)=>{i.d(C,{M:()=>P});var d=i(467),u=i(1626),g=i(5312),f=i(4438);const l=g.c.servidorVst;let P=(()=>{var e;class r{constructor(t){this.http=t}getToken(t="",s=""){let c=new u.Lr;const _=(new u.Nl).set("username",t).set("password",s).set("grant_type","password");return c.append("Content-Type","application/x-www-form-urlencoded"),this.http.post(l+"login",_,{headers:c})}getTokenPromise(t="",s=""){var c=this;return(0,d.A)(function*(){return new Promise((_,T)=>{let v=new u.Lr;const o=(new u.Nl).set("username",t).set("password",s).set("grant_type","password");v.append("Content-Type","application/x-www-form-urlencoded"),c.http.post(l+"login",o,{headers:v}).subscribe({next:h=>{_(h.access_token)},error:h=>{T("")}})})})()}getEstadoCuenta(t="",s=""){var c=this;return(0,d.A)(function*(){return new Promise((_,T)=>{const v=(new u.Lr).set("Authorization","Bearer "+s);c.http.get(l+"cuenta/"+t,{headers:v}).subscribe({next:o=>{console.log("valor",o),_(o)},error:o=>{T("")}})})})()}registrarCuenta(t="",s=""){const c=(new u.Lr).set("Authorization","Bearer "+s);return console.log(s),c.set("Accept","*/*"),c.set("Connection","keep-alive"),this.http.post(l+"cuenta/"+t,null,{headers:c})}autorizarCuenta(t="",s=""){const c=(new u.Lr).set("Authorization","Bearer "+s);return console.log(s),c.set("Accept","*/*"),c.set("Connection","keep-alive"),this.http.post(l+"cuenta/"+t+"/autorizacion",null,{headers:c})}getComercios(t=""){let s=(new u.Lr).set("Authorization","Bearer "+t);return s.append("Content-Type","application/json"),this.http.get(l+"comercios",{headers:s})}getUnComercio(t="",s=""){var c=this;return(0,d.A)(function*(){return yield new Promise((_,T)=>{let v=(new u.Lr).set("Authorization","Bearer "+t);v.append("Content-Type","application/json"),c.http.get(l+"comercio/"+s,{headers:v}).subscribe({next:o=>{_(o)},error:o=>{T("")}})})})()}}return(e=r).\u0275fac=function(t){return new(t||e)(f.KVO(u.Qq))},e.\u0275prov=f.jDH({token:e,factory:e.\u0275fac,providedIn:"root"}),r})()},7291:(y,C,i)=>{i.d(C,{n:()=>f});var d=i(467),u=i(4438),g=i(369);let f=(()=>{var l;class P{constructor(r){this.storage=r,this.tiendas=[],this.usuario={},this._storage=null,this.init()}init(){var r=this;return(0,d.A)(function*(){const n=yield r.storage.create();r._storage=n})()}guardarUsuario(r){var n=this;return(0,d.A)(function*(){var t;console.log("storage",r),null===(t=n._storage)||void 0===t||t.set("usuario",r)})()}cargarUsuario(){var r=this;return(0,d.A)(function*(){var n;return r.usuario=yield null===(n=r._storage)||void 0===n?void 0:n.get("usuario"),r.usuario||[]})()}guardarTiendas(r){var n=this;return(0,d.A)(function*(){var t;console.log("storage",r),null===(t=n._storage)||void 0===t||t.set("tiendas",r),console.log("storage2",r)})()}cargarTiendas(){var r=this;return(0,d.A)(function*(){var n;const t=yield null===(n=r._storage)||void 0===n?void 0:n.get("tiendas");return r.tiendas=null!=t?t:[],r.tiendas})()}borrarTiendas(){var r=this;return(0,d.A)(function*(){var n;yield null===(n=r._storage)||void 0===n?void 0:n.remove("tiendas")})()}borrarUsuario(){var r=this;return(0,d.A)(function*(){var n;yield null===(n=r._storage)||void 0===n?void 0:n.remove("usuario")})()}}return(l=P).\u0275fac=function(r){return new(r||l)(u.KVO(g.w))},l.\u0275prov=u.jDH({token:l,factory:l.\u0275fac,providedIn:"root"}),P})()}}]);