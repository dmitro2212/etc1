
const btn=document.getElementById('themeToggle');
if(localStorage.theme==='dark'){document.body.classList.add('dark')}
if(btn){
 btn.onclick=()=>{
  document.body.classList.toggle('dark');
  localStorage.theme=document.body.classList.contains('dark')?'dark':'light';
 }
}
