import{J as I,D as X,E as Y,i as rr,P as nr,j as tr,o as e,c as o,a as r,n as d,t as s,f as i,b as v,u as a,Q as er,R as or,$ as sr,l as ir,h as u,r as cr}from"./app-BbUmsuxO.js";const lr={class:"flex flex-col"},ar={class:"bg-white"},dr=["src"],ur={key:0,class:"px-1 py-0.5 bg-red-500 rounded-md text-white text-[16px] font-medium absolute top-2 left-2"},pr={class:"bg-white p-2 flex flex-col items-start gap-2 col-span-2"},hr={class:"flex justify-between items-center w-full"},vr={class:"flex justify-between items-center w-full"},fr={class:"flex items-center gap-2"},gr={class:"text-primary text-base font-bold leading-normal"},mr={key:0,class:"text-slate-400 text-sm font-normal line-through leading-tight"},wr={key:0},xr={class:"grid grid-cols-2 md:grid-cols-3 space-y-2 w-full"},_r={key:0,class:"flex items-center gap-1 ml-0 md:ml-2"},yr={class:"text-slate-950 font-bold leading-tight flex items-center"},kr={key:1,class:"flex items-center gap-1"},br={class:"flex items-center gap-1 text-slate-950 font-bold leading-tight"},Cr={key:2,class:"flex items-center gap-1"},zr={class:"flex items-center text-slate-950 gap-2 font-bold leading-tight"},Mr={key:3,class:"flex items-center gap-1"},Vr={class:"text-slate-950 font-bold leading-tight"},jr={key:4,class:"flex items-center gap-2"},Br={class:"text-slate-950 font-bold leading-tight"},Hr={class:"flex font-bold leading-tight flex items-center gap-2"},Pr={class:"w-full p-2"},Ar={key:0,class:"justify-start items-center gap-3 flex w-full"},qr={class:"text-primary text-sm font-normal flex justify-between gap-2 leading-tight"},Sr={__name:"ProductCard",props:{product:Object},setup(Q){var w,x;const U=I(),f=X();Y();const l=rr(),p=nr(),n=Q;(w=n.product)==null||w.id;const G=()=>{var t;const c=(t=n.product)==null?void 0:t.pdf_file;c?window.open(c,"_blank"):p.error("PDF file not available for this product.",{position:"bottom-left"})},g=tr((x=n.product)==null?void 0:x.is_favorite),m=()=>{if(l.token===null)return l.loginModal=!0;axios.post("/favorite-add-or-remove",{product_id:n.product.id},{headers:{Authorization:l.token}}).then(c=>{n.product.is_favorite=!n.product.is_favorite,g.value=c.data.data.product.is_favorite,g.value===!1?p.warning("Product removed from favorite",{position:"bottom-left"}):p.success("Product added to favorite",{position:"bottom-left"}),l.favoriteRemove=!0,l.fetchFavoriteProducts()})},h=()=>{n.product.quantity>0&&U.push({name:"productDetails",params:{id:n.product.id}})};return(c,t)=>{var _,y,k,b,C,z,M,V,j,B,H,P,A,q,D,S,N,$,R,F,E,O,T,W,Z,J,K,L;return e(),o("div",{class:d(["rounded-lg border transition-all mx-1 duration-300 group bg-white overflow-hidden relative",((_=n.product)==null?void 0:_.quantity)>0?"hover:border-primary":""])},[r("div",lr,[r("div",ar,[r("div",{class:d(["w-full h-36 sm:h-52 overflow-hidden relative",((y=n.product)==null?void 0:y.quantity)>0?"":"opacity-30"])},[r("div",{class:"cursor-pointer",onClick:h},[r("img",{src:(k=n.product)==null?void 0:k.thumbnail,loading:"lazy",class:"w-full h-full group-hover:scale-110 transition duration-500 object-cover"},null,8,dr)]),(b=n.product)!=null&&b.is_special?(e(),o("div",ur," 🔥"+s(c.$t("Special")),1)):i("",!0),(C=n.product)!=null&&C.is_favorite?(e(),o("button",{key:1,class:"absolute top-2 right-2 w-9 h-9 rounded-[10px] justify-center items-center flex cursor-pointer bg-white",onClick:m},[v(a(er),{class:"w-6 h-6 text-red-500"})])):(e(),o("button",{key:2,class:"absolute flex sm:hidden group-hover:flex top-2 right-2 w-9 h-9 rounded-[10px] justify-center items-center cursor-pointer bg-white transition-all duration-300",onClick:m},[v(a(or),{class:"w-6 h-6 text-slate-600"})]))],2),r("div",{class:"cursor-pointer",onClick:h},[r("div",pr,[r("div",hr,[r("div",{class:d(["text-slate-950 text-base font-normal leading-normal truncate w-full",((z=n.product)==null?void 0:z.quantity)>0?"":"opacity-30"])},s((M=n.product)==null?void 0:M.name)+" - "+s((V=n.product)==null?void 0:V.model),3),r("div",null,[(j=n.product)!=null&&j.pdf_file?(e(),o("span",{key:0,class:"text-primary cursor-pointer",onClick:sr(G,["stop"])},t[0]||(t[0]=[r("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24",fill:"currentColor",class:"size-6"},[r("path",{"fill-rule":"evenodd",d:"M12 2.25a.75.75 0 0 1 .75.75v11.69l3.22-3.22a.75.75 0 1 1 1.06 1.06l-4.5 4.5a.75.75 0 0 1-1.06 0l-4.5-4.5a.75.75 0 1 1 1.06-1.06l3.22 3.22V3a.75.75 0 0 1 .75-.75Zm-9 13.5a.75.75 0 0 1 .75.75v2.25a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5V16.5a.75.75 0 0 1 1.5 0v2.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V16.5a.75.75 0 0 1 .75-.75Z","clip-rule":"evenodd"})],-1)]))):i("",!0)])]),r("div",{class:d(["flex justify-between gap-2",((B=n.product)==null?void 0:B.quantity)>0?"":"opacity-30"])},null,2),r("div",vr,[r("div",fr,[r("div",gr,s(a(f).showCurrency(((H=n.product)==null?void 0:H.discount_price)>0?(P=n.product)==null?void 0:P.discount_price:(A=n.product)==null?void 0:A.price)),1),((q=n.product)==null?void 0:q.discount_price)>0?(e(),o("div",mr,s(a(f).showCurrency((D=n.product)==null?void 0:D.price)),1)):i("",!0)]),(S=n.product)!=null&&S.is_special?(e(),o("div",wr," 🔥 ")):i("",!0)]),r("div",xr,[(N=n.product)!=null&&N.driving_range?(e(),o("div",_r,[r("div",yr,[t[1]||(t[1]=ir('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="4" x2="5" y2="16"></line><line x1="5" y1="4" x2="14" y2="8"></line><line x1="5" y1="12" x2="14" y2="8"></line><ellipse cx="5" cy="18" rx="3" ry="2" fill="none"></ellipse></svg>',1)),u(" "+s(($=n.product)==null?void 0:$.driving_range)+" Km ",1)])])):i("",!0),(R=n.product)!=null&&R.battery_capacity?(e(),o("div",kr,[r("div",br,[t[2]||(t[2]=r("svg",{xmlns:"http://www.w3.org/2000/svg",width:"24",height:"24",fill:"currentColor",stroke:"currentColor","stroke-width":"0",version:"1.2",baseProfile:"tiny"},[r("path",{d:`\r
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
                                    `})],-1)),u(" "+s((F=n.product)==null?void 0:F.battery_capacity)+"kWh ",1)])])):i("",!0),(E=n.product)!=null&&E.year?(e(),o("div",Cr,[r("div",zr,[t[3]||(t[3]=r("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 448 512",width:"1em",height:"1em",fill:"currentColor",stroke:"currentColor","stroke-width":"0"},[r("path",{d:`\r
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
                                        `})],-1)),u(" "+s((O=n.product)==null?void 0:O.year),1)])])):i("",!0),(T=n.product)!=null&&T.peak_power?(e(),o("div",Mr,[t[4]||(t[4]=r("svg",{xmlns:"http://www.w3.org/2000/svg",width:"24",height:"24",viewBox:"0 0 24 24",fill:"currentColor",stroke:"currentColor","stroke-width":"0"},[r("path",{fill:"none",d:"M0 0h24v24H0z"}),r("path",{d:`\r
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
                                    `})],-1)),r("div",Vr,s((W=n.product)==null?void 0:W.peak_power)+" kW ",1)])):i("",!0),(Z=n.product)!=null&&Z.acceleration_time?(e(),o("div",jr,[t[5]||(t[5]=r("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 16 16",width:"20",height:"20",fill:"currentColor",stroke:"currentColor","stroke-width":"0"},[r("path",{d:`\r
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
                                        `}),r("path",{"fill-rule":"evenodd",d:`\r
                                        M6.664 15.889\r
                                        A8 8 0 1 1 9.336.11\r
                                        a8 8 0 0 1-2.672 15.78\r
                                        z\r
\r
                                        m-4.665-4.283\r
                                        A11.95 11.95 0 0 1 8 10\r
                                        c2.186 0 4.236.585 6.001 1.606\r
                                        a7 7 0 1 0-12.002 0\r
                                        `})],-1)),r("div",Br,s((J=n.product)==null?void 0:J.acceleration_time)+" s ",1)])):i("",!0),r("div",Hr,[t[6]||(t[6]=r("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 576 512",width:"20",height:"20",fill:"currentColor",stroke:"currentColor","stroke-width":"0"},[r("path",{d:`\r
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
                                    `})],-1)),u(" "+s((K=n.product)==null?void 0:K.visit_count),1)])])])])]),r("div",Pr,[((L=n.product)==null?void 0:L.quantity)>0?(e(),o("div",Ar,[r("button",{class:"justify-center items-center gap-0.5 flex border border-primary grow py-2.5 rounded-[10px]",onClick:h},[r("div",qr,[r("span",null,s(c.$t("Detail")),1),v(a(cr),{class:"w-4 h-4 text-primary"})])])])):i("",!0)])])],2)}}};export{Sr as _};
