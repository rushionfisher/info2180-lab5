window.onload = function() {

  const  input = document.getElementById('country');
  const  result = document.getElementById('result');
  const  lookup = document.getElementById('lookup');
  const  city = document.getElementById('cities');
  const  httpReq= new XMLHttpRequest();
   
  const REG=(url)=>{
	httpReq.onreadystatechange = callback;
	httpReq.open('GET', url);
	httpReq.send();
  }
    lookup.addEventListener('click', function(event) {
    event.preventDefault();
    const searchText = input.value;
    let stored = searchText.trim();
    const  url = `world.php?country=${stored}`;
    REG(url);
  });

    city.addEventListener('click', function(event) {
    event.preventDefault();
    const searchText = input.value;
    let save = searchText.trim();
    const  url = `world.php?country=${save}&context=${save}`;
    REG(url);
  });

  const callback=()=> {
    input.value = '';
    if (httpReq.readyState === XMLHttpRequest.DONE) {
      if (httpReq.status === 200) {
        const res = httpReq.responseText;
		result.innerHTML=res;
      } else {
        alert('Unfortunately, there was a problem with the request.');
      }
    }
  }
}