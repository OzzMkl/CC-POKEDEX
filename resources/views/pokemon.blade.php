<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Lista de Pokémon</title>
    <style>
        .card {
            height: 180px;
            display: flex;
            flex-direction: column;
        }

        .card-img-top {
            width: 60px;
            height: 60px;
            object-fit: contain;
            margin: 0 auto;
            margin-top: 10px
        }

        .card-body {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Pokedex</h2>
        <div class="row">
            @foreach ($pokemonList as $pokemon)
                <div class="col-md-4 mt-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#pokemonModal" data-pokemon-id="{{ $pokemon->id }}">
                        <div class="card">
                            <img src="{{ $pokemon->sprites['other']['showdown']['front_default'] }}" class="card-img-top" alt="{{ $pokemon->name }}">
                            <div class="card-body">
                                <h5 class="card-title text-center">{{ $pokemon->name }}</h5>
                                <div class="text-center">
                                    Type:
                                    @foreach ($pokemon->types as $type)
                                        <span class="badge rounded-pill text-bg-danger">{{ $type['type']['name'] }}</span> 
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            @if ($offset > 0)
                <a href="?offset={{ $offset - $limit }}" class="btn btn-primary me-2">Anterior</a>
            @endif
            <a href="?offset={{ $offset + $limit }}" class="btn btn-primary">Siguiente</a>
        </div>
    </div>

    <div class="modal fade" id="pokemonModal" tabindex="-1" aria-labelledby="pokemonModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pokemonModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="pokemonModalBody">
                    <div id="loading-spinner" class="spinner-border text-primary text-center" role="status" style="display: none;">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        const pokemonModal = document.getElementById('pokemonModal')
        pokemonModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const pokemonId = button.getAttribute('data-pokemon-id');
    
            document.getElementById('loading-spinner').style.display = 'block';
            const modalBody = pokemonModal.querySelector('.modal-body');

            fetch(`/pokemon/${pokemonId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('loading-spinner').style.display = 'none';

                    const modalTitle = pokemonModal.querySelector('.modal-title');
    
                    modalTitle.textContent = data.descriptions[5].description;
                    
                    modalBody.innerHTML = '';
    
                    const detailsHtml = `
                        <p><strong>ID:</strong> ${data.id}</p>
                        <p><strong>Gene:</strong> ${data.gene_modulo}</p>
                        <p><strong>Posible Valor:</strong> ${data.possible_values.join(", ")}</p>
                        </div>`; 
                    modalBody.innerHTML = detailsHtml;
                })
                .catch(error => {
                    document.getElementById('loading-spinner').style.display = 'none';

                    console.error('Error fetching Pokémon details:', error);
                    modalBody.textContent = 'Error al cargar los detalles del Pokémon.';
                });
        })
    </script>
    

</body>
</html>
