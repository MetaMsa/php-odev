var change = () => {
  if(document.getElementById("register").style.display == "none"){
    document.getElementById("register").style.display = "";
    document.getElementById("login").style.display = "none";
    document.getElementById("btn").innerHTML = "Giriş Yap";
  }
  else
    {
        document.getElementById("register").style.display = "none";
        document.getElementById("login").style.display = "";
        document.getElementById("btn").innerHTML = "Kayıt Ol";
    }
}