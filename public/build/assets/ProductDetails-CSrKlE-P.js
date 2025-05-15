import{o as s,c as n,a as e,D as xe,h as Q,u as c,t as l,b as d,I as O,e as M,w as y,f as i,F as m,d as h,k as v,P as Me,L as Pe,J as Ve,E as Se,j as Be,m as Re,l as je,g as L,i as w,n as E,R as Ae,Q as He,M as ve,W as pe,$ as Te,a0 as me}from"./app-BZZix_vg.js";import{_ as Ne}from"./ProductCardHorizontal-DASs2vWg.js";import{S as he,a as ge}from"./swiper-vue-5bg48xu9.js";import{N as De}from"./navigation-mOXyV9i5.js";import{T as Fe}from"./thumbs-NG0X_g2n.js";import{_ as Ue,a as Le,f as Ee}from"./Review-DwPqqS7D.js";import{_ as Qe}from"./ProductCard-C_veGjv6.js";import"./swiper-D8GLvp5l.js";/* empty css                  *//* empty css                   */import"./thumbs-l0sNRNKZ.js";import{r as Oe}from"./HomeIcon-DxLA4vc9.js";function We(g,f){return s(),n("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor","aria-hidden":"true","data-slot":"icon"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M5 12h14"})])}function Ze(g,f){return s(),n("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor","aria-hidden":"true","data-slot":"icon"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"})])}function Ie(g,f){return s(),n("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor","aria-hidden":"true","data-slot":"icon"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M12 4.5v15m7.5-7.5h-15"})])}function qe(g,f){return s(),n("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor","aria-hidden":"true","data-slot":"icon"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"})])}const Je={class:"flex flex-col md:flex-row xl:flex-col items-center gap-6"},Ge={key:0,class:"bg-slate-50 hover:border-primary transition w-full grow rounded-xl border border-slate-100 xl:mt-6"},Ke={class:"flex justify-between items-center gap-4 p-4"},Xe={class:"flex items-center gap-4 overflow-hidden"},Ye={class:"w-14 h-14 rounded-full overflow-hidden shrink-0"},et=["src"],tt={class:"overflow-hidden"},rt={class:"text-slate-500 text-sm font-normal leading-tight"},st={class:"mt-1.5 text-slate-950 text-base font-medium leading-normal truncate"},nt={class:""},lt={class:"text-slate-800 text-sm font-bold mt-1"},ot={class:"py-2 block text-center"},at={class:"mt-8"},it={class:"text-slate-800 text-base font-medium leading-normal"},dt={class:"flex gap-4 md:grid md:grid-cols-2 lg:grid-cols-3 xl:block xl:space-y-4 mt-4 overflow-x-auto"},fe={__name:"ProductDetailsRightSide",props:{product:Object,popularProducts:Array},setup(g){const f=xe(),R=g;return(k,W)=>{var P,b,_,u,t,V;const p=Q("router-link");return s(),n(m,null,[e("div",Je,[c(f).multiVendor?(s(),n("div",Ge,[e("div",Ke,[e("div",Xe,[e("div",Ye,[e("img",{src:(P=g.product.shop)==null?void 0:P.logo,loading:"lazy",class:"w-full h-full object-cover"},null,8,et)]),e("div",tt,[e("div",rt,l(k.$t("Sold by")),1),e("div",st,l((b=g.product.shop)==null?void 0:b.name),1)])]),e("div",nt,[d(c(O),{class:"w-5 h-5 text-amber-500"}),e("div",lt,l((_=g.product.shop)==null?void 0:_.rating.toFixed(1)),1)])]),(t=(u=R.product)==null?void 0:u.user)!=null&&t.is_individual?i("",!0):(s(),M(p,{key:0,to:"/shops/"+((V=g.product.shop)==null?void 0:V.id),class:"border-t border-slate-100 text-slate-600 text-sm font-normal leading-tight block"},{default:y(()=>[e("span",ot,l(k.$t("Visit Store")),1)]),_:1},8,["to"]))])):i("",!0)]),e("div",at,[e("div",it,l(k.$t("Products From Same Brand")),1),e("div",dt,[(s(!0),n(m,null,h(g.popularProducts,$=>(s(),n("div",{key:$.id,class:"w-[320px] md:w-full shrink-0"},[d(Ne,{product:$},null,8,["product"])]))),128))])])],64)}}},ct={class:"main-container"},ut={key:0,class:"space-y-6 animate-pulse"},vt={class:"grid grid-cols-4 gap-2"},pt={class:"grid grid-cols-2 md:grid-cols-3 gap-4"},mt={class:"grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 xl:grid-cols-5 gap-3"},ht={key:1},gt={class:"grid grid-cols-1 xl:grid-cols-4"},ft={class:"xl:col-span-3 col-span-1 lg:pr-6"},xt={class:"flex items-center gap-2 overflow-hidden pt-4"},_t={class:"grow w-full overflow-hidden"},wt={class:"space-x-1 text-slate-600 text-sm font-normal truncate"},bt={class:"flex flex-wrap lg:flex-nowrap gap-4 mt-6"},yt={class:"lg:w-[480px] w-full"},kt={class:"w-full"},$t={class:"bg-slate-50 rounded-xl border border-slate-100 px-6"},Ct=["src"],zt={class:"px-1 mt-2"},Mt=["src"],Pt={class:""},Vt={key:0},St={class:"mt-3 text-slate-950 text-2xl font-medium leading-normal"},Bt={key:0,class:"px-1 py-1 bg-red-500 text-white rounded-md text-xs"},Rt={key:1},jt={class:"text-muted text-xs"},At={class:"mt-2 text-slate-700 text-base font-normal leading-normal"},Ht={class:"grid grid-cols-2 md:grid-cols-3 space-y-2 w-full mt-4 gap-2"},Tt={key:0,class:"flex items-center gap-1 ml-0 md:ml-2"},Nt={class:"text-slate-950 font-bold leading-tight flex items-center"},Dt={key:1,class:"flex items-center gap-1"},Ft={class:"flex items-center gap-1 text-slate-950 font-bold leading-tight"},Ut={key:2,class:"flex items-center gap-1"},Lt={class:"flex items-center text-slate-950 gap-2 font-bold leading-tight"},Et={key:3,class:"flex items-center gap-1"},Qt={class:"text-slate-950 font-bold leading-tight"},Ot={key:4,class:"flex items-center gap-2"},Wt={class:"text-slate-950 font-bold leading-tight"},Zt={class:"flex font-bold leading-tight flex items-center gap-2"},It={class:"py-5 flex flex-wrap justify-start items-center mt-4 gap-4 border-b border-slate-200"},qt={class:"flex items-center gap-2"},Jt={class:"flex"},Gt={class:"text-slate-800 text-base font-normal leading-normal"},Kt={class:"flex items-center gap-3 py-4 border-slate-200 flex-wrap"},Xt={class:"text-primary text-3xl font-bold leading-9"},Yt={key:0,class:"text-slate-400 text-2xl font-normal line-through leading-loose"},er={key:1,class:"px-2 py-1 bg-red-500 rounded-2xl text-white text-base font-medium"},tr={key:2,class:"flex items-center gap-3 py-4"},rr={class:"w-[40px] md:w-[88px] text-slate-600 text-base font-normal leading-normal"},sr={class:"flex flex-wrap items-center gap-3"},nr=["id","value","onUpdate:modelValue"],lr=["for"],or={key:0,class:"text-slate-500 text-base font-normal"},ar={key:3,class:"flex items-center gap-3 py-4"},ir={class:"w-[40px] md:w-[88px] text-slate-600 text-base font-normal leading-normal"},dr={class:"flex flex-wrap items-center gap-3"},cr=["id","value","onUpdate:modelValue"],ur=["for"],vr={key:0,class:"text-slate-500 text-base font-normal"},pr={class:"flex flex-wrap gap-4"},mr={key:0,class:"p-2 rounded-[10px] border border-slate-100 inline-flex gap-4"},hr={class:"w-6 flex items-center justify-center text-center text-slate-950 text-base font-medium leading-normal"},gr={class:"text-base font-medium leading-normal"},fr={class:"text-base font-medium leading-normal"},xr={class:"block xl:hidden w-full pt-6 border-slate-200"},_r={class:"flex items-center gap-8 flex-wrap border-b mt-3 mb-4 xl:my-6"},wr={key:0,class:""},br=["innerHTML"],yr={key:0,class:"mt-6"},kr={key:1,class:""},$r={class:"text-slate-950 text-lg lg:text-2xl font-medium leading-loose mb-4"},Cr={class:"max-w-2xl"},zr={class:"border-t border-slate-200 mt-6"},Mr={class:"mt-4 lg:mt-6 text-slate-950 text-lg lg:text-2xl font-medium leading-loose"},Pr={class:"space-y-6 mt-6"},Vr={class:"flex justify-between items-center w-full mt-8 gap-4 flex-wrap"},Sr={class:"text-slate-800 text-base font-normal leading-normal"},Br={class:"hidden xl:block col-span-1 w-full pt-6 h-full xl:pt-16 xl:pl-8 xl:border-l border-slate-200 xl:pb-6"},Rr={class:"mt-4 xl:mt-6 text-slate-800 text-lg md:text-2xl lg:text-3xl font-bold leading-9"},jr={class:"grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 xl:grid-cols-5 gap-3 sm:gap-6 items-start my-6"},Zr={__name:"ProductDetails",setup(g){v(7*60*60*1e3);const f=Me(),R=v(null),k=[Ee,De,Fe],W=o=>{R.value=o},p=Pe();Ve();const P=xe(),b=Se(),_=Be(),u=v({product_id:p.params.id,size:null,color:null,unit:null}),t=v({}),V=v([]),$=v([]),S=v(!0),B=v(!1),j=v(null),D=v(!0),_e=()=>{window.dispatchEvent(new Event("open-contact-popup"))};Re(()=>{Z(),window.scrollTo(0,0),C(p.params.id)});const we=o=>{const r=o;console.log("pdfUrl",r),r?window.open(r,"_blank"):f.error("PDF file not available for this product.",{position:"bottom-left"})};je(p,()=>{Z(),S.value=!0,B.value=!1,window.scrollTo({top:0,behavior:"smooth"}),u.value.product_id=p.params.id,C(p.params.id)});const C=o=>{let r=null;b.products.forEach(T=>{T.products.find(N=>{if(N.id==o)return r=N})}),j.value=r,r&&(u.value.size=r.size,u.value.color=r.color,u.value.unit=r.unit)},be=()=>{b.addToCart(u.value,t.value),setTimeout(()=>{C(p.params.id)},500)},ye=()=>{b.decrementQuantity(t.value),setTimeout(()=>{C(p.params.id)},500)},ke=()=>{b.incrementQuantity(t.value),setTimeout(()=>{C(p.params.id)},500)},$e=()=>{if(_.token===null)return _.loginModal=!0;axios.post("/favorite-add-or-remove",{product_id:t.value.id},{headers:{Authorization:_.token}}).then(()=>{t.value.is_favorite=!t.value.is_favorite,t.value.is_favorite===!1?f({component:me,props:{title:"Product removed from favorite",message:"Product removed from favorite successfully"}},{type:"default",hideProgressBar:!0,icon:!1,position:"top-right",toastClassName:"vue-toastification-alert",timeout:3e3}):f({component:me,props:{title:"Product added to favorite",message:"Product added to favorite successfully"}},{type:"default",hideProgressBar:!0,icon:!1,position:"top-right",toastClassName:"vue-toastification-alert",timeout:3e3}),_.fetchFavoriteProducts()}).catch(o=>{console.log(o)})},Ce=()=>{S.value=!1,B.value=!0,I()},Z=async()=>{D.value=!0,axios.get("/product-details",{params:{product_id:p.params.id},headers:{Authorization:_.token}}).then(o=>{t.value=o.data.data.product,V.value=o.data.data.related_products,$.value=o.data.data.popular_products,console.log("product",t.value),t.value.colors.length>0?u.value.color=t.value.colors[0].name:u.value.color=null,t.value.sizes.length>0?u.value.size=t.value.sizes[0].name:u.value.size=null,C(p.params.id)}).catch(o=>{console.log(o)}).finally(()=>{D.value=!1})},A=v({}),F=v(0),U=v([]),z=v(1),H=v(6),ze=o=>{z.value=o,I()},I=async()=>{axios.get("/reviews",{params:{product_id:p.params.id,page:z.value,per_page:H.value}}).then(o=>{F.value=o.data.data.total,U.value=o.data.data.reviews,A.value=o.data.data.average_rating_percentage})};return(o,r)=>{var q,J,G,K,X,Y,ee,te,re,se,ne,le,oe,ae,ie,de,ce,ue;const T=Q("router-link"),N=Q("vue-awesome-paginate");return s(),n("div",ct,[D.value?(s(),n("div",ut,[r[4]||(r[4]=e("div",{class:"flex items-center gap-2 pt-4"},[e("div",{class:"w-6 h-6 bg-slate-200 rounded"}),e("div",{class:"flex-1 h-4 bg-slate-200 rounded"})],-1)),r[5]||(r[5]=e("div",{class:"w-full h-96 bg-slate-200 rounded-xl"},null,-1)),e("div",vt,[(s(),n(m,null,h(4,a=>e("div",{key:a,class:"h-24 bg-slate-200 rounded"})),64))]),r[6]||(r[6]=L('<div class="space-y-2 lg:pl-6"><div class="h-8 bg-slate-200 rounded w-1/2"></div><div class="h-4 bg-slate-200 rounded w-1/4"></div></div><div class="h-4 bg-slate-200 rounded w-full"></div><div class="h-4 bg-slate-200 rounded w-5/6"></div>',3)),e("div",pt,[(s(),n(m,null,h(3,a=>e("div",{key:a,class:"h-6 bg-slate-200 rounded"})),64))]),r[7]||(r[7]=L('<div class="flex items-center gap-4"><div class="h-10 bg-slate-200 rounded w-32"></div><div class="h-6 bg-slate-200 rounded w-20"></div></div><div class="flex gap-4"><div class="h-10 bg-slate-200 rounded flex-1"></div><div class="h-10 bg-slate-200 rounded flex-1"></div></div><div class="mt-6 h-6 bg-slate-200 rounded w-1/4"></div>',3)),e("div",mt,[(s(),n(m,null,h(5,a=>e("div",{key:a,class:"h-48 bg-slate-200 rounded"})),64))])])):(s(),n("div",ht,[e("div",gt,[e("div",ft,[e("div",xt,[d(T,{to:"/",class:"w-6 h-6"},{default:y(()=>[d(c(Oe),{class:"w-5 h-5 text-slate-600"})]),_:1}),e("div",_t,[e("div",wt,[d(T,{to:"/"},{default:y(()=>[w(l(o.$t("Home")),1)]),_:1}),r[8]||(r[8]=e("span",null,"/",-1)),e("span",null,l(t.value.name),1)])])]),e("div",bt,[e("div",yt,[e("div",kt,[e("div",$t,[d(c(ge),{spaceBetween:10,thumbs:{swiper:R.value},modules:k,class:"product-details-slider"},{default:y(()=>[(s(!0),n(m,null,h(t.value.thumbnails,a=>(s(),M(c(he),{key:a.id,class:"max-h-[448px] h-auto"},{default:y(()=>[e("img",{src:a.thumbnail,alt:"",class:"h-full w-full object-contain"},null,8,Ct)]),_:2},1024))),128))]),_:1},8,["thumbs"])]),e("div",zt,[d(c(ge),{onSwiper:W,spaceBetween:10,slidesPerView:4,freeMode:!0,navigation:!0,watchSlidesProgress:!0,modules:k,class:"product-details-thumbnail"},{default:y(()=>[(s(!0),n(m,null,h(t.value.thumbnails,a=>(s(),M(c(he),{key:a.id},{default:y(()=>[e("img",{src:a.thumbnail,alt:"",class:"h-full w-full object-cover"},null,8,Mt)]),_:2},1024))),128))]),_:1})])])]),e("div",Pt,[t.value.categories&&t.value.categories.length?(s(!0),n(m,{key:0},h(t.value.categories,(a,x)=>(s(),n("span",{key:x,class:"text-primary text-xs font-normal leading-none px-1.5 py-1 bg-primary-50 rounded"},[w(l(a.name??"Unknown Brand"),1),x<t.value.categories.length-1?(s(),n("span",Vt,", ")):i("",!0)]))),128)):i("",!0),e("div",St,[w(l(t.value.name)+" ",1),(q=t.value)!=null&&q.is_special?(s(),n("span",Bt," ( 🔥 Special Offer ) ")):i("",!0)]),(J=t.value)!=null&&J.model?(s(),n("div",Rt,[e("span",jt," Model : "+l((G=t.value)==null?void 0:G.model),1)])):i("",!0),e("div",At,l(t.value.short_description),1),e("div",Ht,[(K=t.value)!=null&&K.driving_range?(s(),n("div",Tt,[e("div",Nt,[r[9]||(r[9]=L('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="4" x2="5" y2="16"></line><line x1="5" y1="4" x2="14" y2="8"></line><line x1="5" y1="12" x2="14" y2="8"></line><ellipse cx="5" cy="18" rx="3" ry="2" fill="none"></ellipse></svg>',1)),w(" "+l((X=t.value)==null?void 0:X.driving_range)+"mi ",1)])])):i("",!0),(Y=t.value)!=null&&Y.battery_capacity?(s(),n("div",Dt,[e("div",Ft,[r[10]||(r[10]=e("svg",{xmlns:"http://www.w3.org/2000/svg",width:"24",height:"24",fill:"currentColor",stroke:"currentColor","stroke-width":"0",version:"1.2",baseProfile:"tiny"},[e("path",{d:`\r
                                        M9 16\r
                                            c-.552 0-1-.447-1-1\r
                                            v-4\r
                                            c0-.553.448-1 1-1\r
                                            s1 .447 1 1\r
                                            v4\r
                                            c0 .553-.448 1-1 1\r
                                        z\r
    \r
                                        M6 16\r
                                            c-.552 0-1-.447-1-1\r
                                            v-4\r
                                            c0-.553.448-1 1-1\r
                                            s1 .447 1 1\r
                                            v4\r
                                            c0 .553-.448 1-1 1\r
                                        z\r
    \r
                                        M15 16\r
                                            c-.552 0-1-.447-1-1\r
                                            v-4\r
                                            c0-.553.448-1 1-1\r
                                            s1 .447 1 1\r
                                            v4\r
                                            c0 .553-.448 1-1 1\r
                                        z\r
    \r
                                        M12 16\r
                                            c-.552 0-1-.447-1-1\r
                                            v-4\r
                                            c0-.553.448-1 1-1\r
                                            s1 .447 1 1\r
                                            v4\r
                                            c0 .553-.448 1-1 1\r
                                        z\r
    \r
                                        M19 10\r
                                            c0-1.654-1.346-3-3-3\r
                                            h-11\r
                                            c-1.654 0-3 1.346-3 3\r
                                            v6\r
                                            c0 1.654 1.346 3 3 3\r
                                            h11\r
                                            c1.654 0 3-1.346 3-3\r
                                            1.104 0 2-.896 2-2\r
                                            v-2\r
                                            c0-1.104-.896-2-2-2\r
                                        z\r
    \r
                                        m-2 6\r
                                            c0 .552-.449 1-1 1\r
                                            h-11\r
                                            c-.551 0-1-.448-1-1\r
                                            v-6\r
                                            c0-.552.449-1 1-1\r
                                            h11\r
                                            c.551 0 1 .448 1 1\r
                                            v6\r
                                        z\r
                                        `})],-1)),w(" "+l((ee=t.value)==null?void 0:ee.battery_capacity)+"kWh ",1)])])):i("",!0),(te=t.value)!=null&&te.year?(s(),n("div",Ut,[e("div",Lt,[r[11]||(r[11]=e("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 448 512",width:"1em",height:"1em",fill:"currentColor",stroke:"currentColor","stroke-width":"0"},[e("path",{d:`\r
                                            M0 464\r
                                                c0 26.5 21.5 48 48 48\r
                                                h352\r
                                                c26.5 0 48-21.5 48-48\r
                                                V192\r
                                                H0\r
                                                v272\r
                                                z\r
    \r
                                            M320 268\r
                                                c0-6.6 5.4-12 12-12\r
                                                h40\r
                                                c6.6 0 12 5.4 12 12\r
                                                v40\r
                                                c0 6.6-5.4 12-12 12\r
                                                h-40\r
                                                c-6.6 0-12-5.4-12-12\r
                                                v-40\r
                                                z\r
    \r
                                            m0 128\r
                                                c0-6.6 5.4-12 12-12\r
                                                h40\r
                                                c6.6 0 12 5.4 12 12\r
                                                v40\r
                                                c0 6.6-5.4 12-12 12\r
                                                h-40\r
                                                c-6.6 0-12-5.4-12-12\r
                                                v-40\r
                                                z\r
    \r
                                            M192 268\r
                                                c0-6.6 5.4-12 12-12\r
                                                h40\r
                                                c6.6 0 12 5.4 12 12\r
                                                v40\r
                                                c0 6.6-5.4 12-12 12\r
                                                h-40\r
                                                c-6.6 0-12-5.4-12-12\r
                                                v-40\r
                                                z\r
    \r
                                            m0 128\r
                                                c0-6.6 5.4-12 12-12\r
                                                h40\r
                                                c6.6 0 12 5.4 12 12\r
                                                v40\r
                                                c0 6.6-5.4 12-12 12\r
                                                h-40\r
                                                c-6.6 0-12-5.4-12-12\r
                                                v-40\r
                                                z\r
    \r
                                            M64 268\r
                                                c0-6.6 5.4-12 12-12\r
                                                h40\r
                                                c6.6 0 12 5.4 12 12\r
                                                v40\r
                                                c0 6.6-5.4 12-12 12\r
                                                H76\r
                                                c-6.6 0-12-5.4-12-12\r
                                                v-40\r
                                                z\r
    \r
                                            m0 128\r
                                                c0-6.6 5.4-12 12-12\r
                                                h40\r
                                                c6.6 0 12 5.4 12 12\r
                                                v40\r
                                                c0 6.6-5.4 12-12 12\r
                                                H76\r
                                                c-6.6 0-12-5.4-12-12\r
                                                v-40\r
                                                z\r
    \r
                                            M400 64\r
                                                h-48\r
                                                V16\r
                                                c0-8.8-7.2-16-16-16\r
                                                h-32\r
                                                c-8.8 0-16 7.2-16 16\r
                                                v48\r
                                                H160\r
                                                V16\r
                                                c0-8.8-7.2-16-16-16\r
                                                h-32\r
                                                c-8.8 0-16 7.2-16 16\r
                                                v48\r
                                                H48\r
                                                C21.5 64 0 85.5 0 112\r
                                                v48\r
                                                h448\r
                                                v-48\r
                                                c0-26.5-21.5-48-48-48\r
                                                z\r
                                            `})],-1)),w(" "+l((re=t.value)==null?void 0:re.year),1)])])):i("",!0),(se=t.value)!=null&&se.peak_power?(s(),n("div",Et,[r[12]||(r[12]=e("svg",{xmlns:"http://www.w3.org/2000/svg",width:"24",height:"24",viewBox:"0 0 24 24",fill:"currentColor",stroke:"currentColor","stroke-width":"0"},[e("path",{fill:"none",d:"M0 0h24v24H0z"}),e("path",{d:`\r
                                        M11 21\r
                                            h-1\r
                                            l1-7\r
                                            H7.5\r
                                            c-.88 0-.33-.75-.31-.78\r
                                            C8.48 10.94 10.42 7.54 13.01 3\r
                                            h1\r
                                            l-1 7\r
                                            h3.51\r
                                            c.4 0 .62.19.4.66\r
                                            C12.97 17.55 11 21 11 21\r
                                        z\r
                                        `})],-1)),e("div",Qt,l((ne=t.value)==null?void 0:ne.peak_power)+" kW ",1)])):i("",!0),(le=t.value)!=null&&le.acceleration_time?(s(),n("div",Ot,[r[13]||(r[13]=e("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 16 16",width:"20",height:"20",fill:"currentColor",stroke:"currentColor","stroke-width":"0"},[e("path",{d:`\r
                                            M8 2\r
                                            a.5.5 0 0 1 .5.5\r
                                            V4\r
                                            a.5.5 0 0 1-1 0\r
                                            V2.5\r
                                            A.5.5 0 0 1 8 2\r
    \r
                                            M3.732 3.732\r
                                            a.5.5 0 0 1 .707 0\r
                                            l.915.914\r
                                            a.5.5 0 1 1-.708.708\r
                                            l-.914-.915\r
                                            a.5.5 0 0 1 0-.707\r
    \r
                                            M2 8\r
                                            a.5.5 0 0 1 .5-.5\r
                                            h1.586\r
                                            a.5.5 0 0 1 0 1\r
                                            H2.5\r
                                            A.5.5 0 0 1 2 8\r
    \r
                                            m9.5 0\r
                                            a.5.5 0 0 1 .5-.5\r
                                            h1.5\r
                                            a.5.5 0 0 1 0 1\r
                                            H12\r
                                            a.5.5 0 0 1-.5-.5\r
    \r
                                            m.754-4.246\r
                                            a.39.39 0 0 0-.527-.02\r
                                            L7.547 7.31\r
                                            A.91.91 0 1 0 8.85 8.569\r
                                            l3.434-4.297\r
                                            a.39.39 0 0 0-.029-.518\r
                                            z\r
                                            `}),e("path",{"fill-rule":"evenodd",d:`\r
                                            M6.664 15.889\r
                                            A8 8 0 1 1 9.336.11\r
                                            a8 8 0 0 1-2.672 15.78\r
                                            z\r
    \r
                                            m-4.665-4.283\r
                                            A11.95 11.95 0 0 1 8 10\r
                                            c2.186 0 4.236.585 6.001 1.606\r
                                            a7 7 0 1 0-12.002 0\r
                                            `})],-1)),e("div",Wt,l((oe=t.value)==null?void 0:oe.acceleration_time)+" s ",1)])):i("",!0),e("div",Zt,[r[14]||(r[14]=e("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 576 512",width:"20",height:"20",fill:"currentColor",stroke:"currentColor","stroke-width":"0"},[e("path",{d:`\r
                                        M288 32\r
                                            c-80.8 0-145.5 36.8-192.6 80.6\r
                                            C48.6 156 17.3 208 2.5 243.7\r
                                            c-3.3 7.9-3.3 16.7 0 24.6\r
                                            C17.3 304 48.6 356 95.4 399.4\r
                                            C142.5 443.2 207.2 480 288 480\r
                                            s145.5-36.8 192.6-80.6\r
                                            c46.8-43.5 78.1-95.4 93-131.1\r
                                            c3.3-7.9 3.3-16.7 0-24.6\r
                                            c-14.9-35.7-46.2-87.7-93-131.1\r
                                            C433.5 68.8 368.8 32 288 32\r
                                        z\r
    \r
                                        M144 256\r
                                            a144 144 0 1 1 288 0\r
                                            a144 144 0 1 1 -288 0\r
                                        z\r
    \r
                                        m144-64\r
                                            c0 35.3-28.7 64-64 64\r
                                            c-7.1 0-13.9-1.2-20.3-3.3\r
                                            c-5.5-1.8-11.9 1.6-11.7 7.4\r
                                            c.3 6.9 1.3 13.8 3.2 20.7\r
                                            c13.7 51.2 66.4 81.6 117.6 67.9\r
                                            s81.6-66.4 67.9-117.6\r
                                            c-11.1-41.5-47.8-69.4-88.6-71.1\r
                                            c-5.8-.2-9.2 6.1-7.4 11.7\r
                                            c2.1 6.4 3.3 13.2 3.3 20.3\r
                                        z\r
                                        `})],-1)),w(" "+l((ae=t.value)==null?void 0:ae.visit_count),1)])]),e("div",It,[e("div",qt,[e("div",Jt,[d(c(O),{class:"w-6 h-6 text-amber-500"}),(s(),n(m,null,h(4,a=>d(c(O),{key:a,class:E(["w-6 h-6 2xl:block hidden",a<t.value.rating?"text-amber-500":"text-gray-300"])},null,8,["class"])),64))])]),r[15]||(r[15]=e("div",{class:"w-[1px] h-4 bg-slate-200"},null,-1)),e("div",Gt,l(t.value.visit_count)+" "+l(t.value.visit_count===1?o.$t("View"):o.$t("Views")),1),r[16]||(r[16]=e("div",{class:"w-[1px] h-4 bg-slate-200"},null,-1)),r[17]||(r[17]=e("div",{class:"w-[1px] h-4 bg-slate-200"},null,-1)),e("button",{class:"border-none",onClick:$e},[t.value.is_favorite?(s(),M(c(He),{key:1,class:"w-6 h-6 text-red-500"})):(s(),M(c(Ae),{key:0,class:"w-6 h-6 text-slate-600"}))])]),e("div",Kt,[e("div",Xt,l(c(P).showCurrency(t.value.discount_price>0?t.value.discount_price:t.value.price)),1),t.value.discount_price>0?(s(),n("div",Yt,l(c(P).showCurrency(t.value.price)),1)):i("",!0),t.value.discount_percentage?(s(),n("div",er,l(t.value.discount_percentage)+"% "+l(o.$t("OFF")),1)):i("",!0)]),((ie=t.value.sizes)==null?void 0:ie.length)>0?(s(),n("div",tr,[e("div",rr,l(o.$t("Size")),1),e("div",sr,[(s(!0),n(m,null,h(t.value.sizes,a=>(s(),n("div",{key:a.id,class:"relative"},[ve(e("input",{type:"radio",name:"size",id:"size-"+a.name,class:"peer hidden",value:a.name,"onUpdate:modelValue":x=>u.value.size=x},null,8,nr),[[pe,u.value.size]]),e("label",{for:"size-"+a.name,class:"min-w-11 w-auto h-9 flex justify-center items-center border-2 border-slate-200 rounded-md cursor-pointer peer-checked:border-primary peer-checked:bg-primary-100 px-2"},l(a.name),9,lr)]))),128)),t.value.sizes?i("",!0):(s(),n("div",or,l(o.$t("N/A")),1))])])):i("",!0),((de=t.value.colors)==null?void 0:de.length)>0?(s(),n("div",ar,[e("div",ir,l(o.$t("Color")),1),e("div",dr,[(s(!0),n(m,null,h(t.value.colors,a=>(s(),n("div",{key:a.id,class:"relative"},[ve(e("input",{type:"radio",name:"color",id:"color-"+a.name,class:"peer hidden",value:a.name,"onUpdate:modelValue":x=>u.value.color=x},null,8,cr),[[pe,u.value.color]]),e("label",{for:"color-"+a.name,class:"px-2 py-1 flex justify-center items-center border-2 border-slate-200 rounded-md cursor-pointer peer-checked:border-primary peer-checked:bg-primary-100"},l(a.name),9,ur)]))),128)),t.value.colors?i("",!0):(s(),n("div",vr,l(o.$t("N/A")),1))])])):i("",!0),e("div",pr,[j.value?(s(),n("div",mr,[e("button",{class:"bg-slate-200 p-2 rounded",onClick:ye},[d(c(We),{class:"w-6 h-6 text-slate-800"})]),e("div",hr,l(j.value.quantity),1),e("button",{class:"bg-slate-100 p-2 rounded",onClick:ke},[d(c(Ie),{class:"w-6 h-6 text-slate-800"})])])):i("",!0),e("button",{onClick:_e,class:"grow w-full md:max-w-56 justify-center items-center text-primary flex gap-2 px-6 py-4 rounded-[10px] border border-primary"},[d(c(Ze),{class:"w-5 h-5 text-primary"}),e("div",gr,l(o.$t("Contact")),1)]),j.value?i("",!0):(s(),n("button",{key:1,class:"grow w-full md:max-w-56 justify-center items-center text-primary flex gap-2 px-6 py-4 rounded-[10px] border border-primary",onClick:be},[d(c(qe),{class:"w-5 h-5 text-primary"}),e("div",fr,l(o.$t("Add to Cart")),1)]))])])]),e("div",xr,[d(fe,{product:t.value,popularProducts:$.value},null,8,["product","popularProducts"])]),e("div",_r,[e("button",{class:E(["py-3 transition text-base font-medium leading-normal border-b",S.value?"text-primary border-primary":"text-slate-600 border-transparent"]),onClick:r[0]||(r[0]=a=>{S.value=!0,B.value=!1})},l(o.$t("About Product")),3),e("button",{class:E(["py-3 transition text-base font-medium leading-normal border-b",B.value?"text-primary border-primary":"text-slate-600 border-transparent"]),onClick:r[1]||(r[1]=a=>Ce())},l(o.$t("Reviews")),3)]),S.value?(s(),n("div",wr,[e("div",{innerHTML:t.value.description},null,8,br),(ce=t.value)!=null&&ce.pdf_file?(s(),n("div",yr,[r[19]||(r[19]=e("h3",{class:"text-lg font-medium text-slate-800 mb-3"},"Additional Document",-1)),e("a",{onClick:r[2]||(r[2]=Te(a=>{var x;return we((x=t.value)==null?void 0:x.pdf_file)},["stop"])),target:"_blank",class:"inline-flex cursor-pointer items-center gap-2 px-4 py-2 border border-primary text-primary rounded-lg hover:bg-primary-50 transition"},r[18]||(r[18]=[e("svg",{xmlns:"http://www.w3.org/2000/svg",class:"h-5 w-5",fill:"none",viewBox:"0 0 24 24",stroke:"currentColor"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"})],-1),w(" Read PDF ")]))])):i("",!0)])):i("",!0),B.value?(s(),n("div",kr,[e("div",$r,l(o.$t("Rating and Review")),1),e("div",Cr,[d(Ue,{reviewRatings:A.value.percentages,avarageRating:(ue=A.value)==null?void 0:ue.rating,totalReview:A.value.total_review},null,8,["reviewRatings","avarageRating","totalReview"])]),e("div",zr,[e("div",Mr,l(o.$t("Reviews")),1),e("div",Pr,[(s(!0),n(m,null,h(U.value,a=>(s(),M(Le,{key:a.id,review:a},null,8,["review"]))),128))]),e("div",Vr,[e("div",Sr,l(o.$t("Showing"))+" "+l(H.value*(z.value-1)+1)+" "+l(o.$t("to"))+" "+l(H.value*(z.value-1)+U.value.length)+" "+l(o.$t("of"))+" "+l(F.value)+" "+l(o.$t("results")),1),e("div",null,[d(N,{"total-items":F.value,"items-per-page":H.value,type:"button","max-pages-shown":3,modelValue:z.value,"onUpdate:modelValue":r[3]||(r[3]=a=>z.value=a),"hide-prev-next-when-ends":!0,onClick:ze},null,8,["total-items","items-per-page","modelValue"])])])])])):i("",!0)]),e("div",Br,[d(fe,{product:t.value,popularProducts:$.value},null,8,["product","popularProducts"])])]),e("div",Rr,l(o.$t("Similar Products")),1),e("div",jr,[(s(!0),n(m,null,h(V.value,a=>(s(),n("div",{key:a.id},[d(Qe,{product:a},null,8,["product"])]))),128))])]))])}}};export{Zr as default};
