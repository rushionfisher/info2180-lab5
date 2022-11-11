window.onload = function() {

    const  input = document.getElementById('country');
    const  result = document.getElementById('result');
    const  look = document.getElementById('lookup');
    const  httpReq= new XMLHttpRequest();
    const REG=(url)=>{
      httpReq.onreadystatechange = callback;
      httpReq.open('GET', url);
      httpReq.send();
    }
    look.addEventListener('click', function(event) {
      event.preventDefault();
      const searchText = input.value;
      let stored = searchText.trim();
      const  url = `world.php?country=${stored}`;
      REG(url);
      console.log(stored)
    });
  
    function callback() {
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