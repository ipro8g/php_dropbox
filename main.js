let posts;

window.addEventListener("load", charge);

function charge(){

	const req_ob77 = {
            
                    "method":"load_posts"
    }
	
	load_posts(req_ob77).then();
}

function append_posts(){
	
	posts.forEach((post)=>{
					
					const d = document.createElement("div");
					d.setAttribute("style", "display:flex;flex-direction:column;align-items:center;border:2px solid black;margin:5px;padding:5px;border-radius:5px;");
					const h3 = document.createElement("h3");
					h3.innerText = post.name;
					
					const a = document.createElement("a");
					a.setAttribute("download", post.name);
					a.setAttribute("href", `data:${post.type};base64,${post.content}`);
					a.innerText = post.name;
					
					const h4 = document.createElement("h4");
					h4.innerText = post.author;
					const s = document.createElement("small");
					s.innerText = post.size + " Bytes";
					const s2 = document.createElement("small");
					s2.innerText = post.type;
					const p = document.createElement("p");
					p.innerText = post.comments;
					
					const post_container = document.getElementById("post_container");
					d.appendChild(h3);
					d.appendChild(a);
					d.appendChild(h4);
					d.appendChild(s);
					d.appendChild(s2);
					d.appendChild(p);
					post_container.appendChild(d);
	})
}


async function load_posts(req_ob77){

	const xhr = new XMLHttpRequest();
    xhr.open("POST", "retrieve.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    
    xhr.send(JSON.stringify(req_ob77));

    xhr.onreadystatechange = ()=>{

        if (xhr.readyState === 4) {

                const res_ob = JSON.parse(xhr.response);
				
				posts = JSON.parse(res_ob);
				
				append_posts();
        }
    }
}

async function send_post(){

	const formData = new FormData();
	
	formData.append("author", document.getElementById("author").value);
	formData.append("comment", document.getElementById("comment").value);
	formData.append("file", document.getElementById("file").files[0]);
	
	const xhr = new XMLHttpRequest();
    xhr.open("POST", "handler.php", true);
    
    xhr.send(formData);

    xhr.onreadystatechange = ()=>{

        if (xhr.readyState === 4) {

                if(xhr.response == 1){
					
					alert("file successfully saved");
				}
				
				document.getElementById("author").value = "";
				document.getElementById("comment").value = "";
				document.getElementById("file").value = "";
				
				post_container.innerHTML = "";
				
				const req_ob77 = {
            
                    "method":"load_posts"
				}
	
				load_posts(req_ob77).then();
        }
    }
}