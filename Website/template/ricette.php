<h1 class="px-5 py-2">Ricette</h1>
<div class="d-flex justify-content-center">
    <label hidden for="search-bar">Search</label>
    <input id="search-bar" type="search" class="form-control w-50" placeholder="Search" oninput="return filter(this);"/>
</div>
<!-- Ricetta -->
<div class="container py-2">
    <div class="row text-center g-2" id="searchResult">
        <?php foreach($templateParams["ricette"] as $ricetta): ?>
        <div class="col-12 col-md-3">
            <div class="card bg-light my-2">
                <div class="row">
                    <div class="col-6 col-md-12 mx-auto d-flex">
                        <a href="paginaRicetta.php?titoloRicetta=<?php echo str_replace(' ', '%20', $ricetta['titolo']); ?>">
                            <img src="<?php echo UPLOAD_DIR.$ricetta["img"]; ?>" class="img-fluid rounded-left mx-auto" alt="...">
                        </a>
                    </div>
                    <div class="col-6 col-md-12">
                        <div class="card-body ">
                            <p class="card-title fs-6 cut-text"><a href="paginaRicetta.php?titoloRicetta=<?php echo str_replace(' ', '%20', $ricetta['titolo']); ?>"><?php echo $ricetta["titolo"]; ?></a></p>
                            <p class="card-text">
                                Autore: </br>
                                <?php echo $ricetta["autore"]; ?> </br> 
                                <small class="text-muted"><?php echo $ricetta["data"]; ?></small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>


<script>
   
    const original = document.querySelector("div#searchResult").innerHTML
    let precFiltered = []
    function filter(bar){
        let inserted = bar.value
        if(inserted === ''){
            document.querySelector("div#searchResult").innerHTML = original
        }
        let elems = document.querySelector("div#searchResult").children
        let filtered = []
        for(let x of elems){
            if (x.children[0].children[0].children[1].children[0].children[0].children[0].textContent.toLowerCase().includes(inserted.toLowerCase())){
                filtered.push(x)
            }
        }
        let content = ''
        for(let e of filtered){
            content += e.outerHTML
        }
        if(precFiltered !== content){
            document.querySelector("div#searchResult").innerHTML = content
            precFiltered = content
        }
       
    }
</script>