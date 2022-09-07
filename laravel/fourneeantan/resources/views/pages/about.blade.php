@extends('layouts.app')

@section('content')
        <h2 class="text-4xl my-8">Bienvenue</h2>

        <div class="slider">
            <div class="slide active">
              <img src="{{asset('images/image1.jpg')}}" alt="image 1">
            </div>
            <div class="slide">
                <img src="{{asset('images/image2.jpg')}}" alt="image 2">
            </div>
            <div class="slide">
                <img src="{{asset('images/image3.jpg')}}" alt="image 3">
            </div>
            <div class="slide">
                <img src="{{asset('images/image4.jpg')}}" alt="image 4">
            </div>
            <div class="slide">
                <img src="{{asset('images/image5.jpg')}}" alt="image 5">
            </div>
            <div class="navigation">
              <i class="fas fa-chevron-left prev-btn"></i>
              <i class="fas fa-chevron-right next-btn"></i>
            </div>
            <div class="navigation-visibility">
              <div class="slide-icon active"></div>
              <div class="slide-icon"></div>
              <div class="slide-icon"></div>
              <div class="slide-icon"></div>
              <div class="slide-icon"></div>
            </div>
          </div>
          <script src="{{ asset('js/caroussel.js')}}"></script>

          <div class="h-auto w-full flex flex-wrap justify-center items-center content-center lg:my-20">
            <h2 class="h3 text-center w-full mb-4">Les produits utilisés</h2>
            <div class="w-full lg:w-1/3 p-8">
                <img src="{{asset('images/image_farine.jpg')}}" alt="image 1">
            </div>
            <div class="w-full lg:w-1/3 text-center">
              <p class="text-justify p-8">La farine provient principalement de céréales panifiables — blé (froment), épeautre ou seigle. On peut y adjoindre, en quantité modérée, des farines d’autres denrées non panifiables tels que le sarrasin, l’orge, le maïs, la châtaigne, la noix… Les céréales panifiables se caractérisent par la présence de gluten, ensemble de protéines aux propriétés élastiques, qui permettent d’emprisonner les bulles de dioxyde de carbone dégagées par la fermentation, qui permet la montée de la pâte, dite « pâte levée », et crée la mie.
              </p>
              <p class="text-justify p-8">Cette fermentation, dite fermentation alcoolique, produit outre le dioxyde de carbone, de l’éthanol, qui est vaporisé lors de la cuisson. Sans ajout de levain ou levure, le pain est dit azyme.
              </p>
            </div>
          </div>
          
          
          <div class="h-auto w-full flex flex-wrap justify-center items-center content-center lg:my-20">
            <h2 class="h3 text-center w-full mb-4 order-1">Le pain</h2>
            <div class="w-full text-center order-3 lg:w-1/3  lg:order-2">
              <p class="text-justify p-8">Le pain est l’aliment de base traditionnel de nombreuses cultures. Il est fabriqué à partir des ingrédients qui sont la farine et l’eau. Il contient généralement du sel. D’autres ingrédients s’ajoutent selon le type de pain et la manière dont il est préparé culturellement. Lorsqu’on ajoute le levain ou la levure, la pâte du pain est soumise à un gonflement dû à la fermentation.
              </p>
              <p class="text-justify p-8">Le pain est obtenu par cuisson de la pâte, au four traditionnel, ou four à pain, ou par d’autres méthodes (pierres chaudes par exemple). Une personne dont le métier est de fabriquer le pain (panification) est un boulanger. Le pain est commercialisé dans une boulangerie.
              </p>
            </div>
            <div class="w-full order-2 p-8 lg:w-1/3 lg:order-3">
              <img src="{{asset('images/fourapain.jpg')}}" alt="image 3">
          </div>
          </div>

          <div class="h-auto w-full flex flex-wrap justify-center items-center content-center lg:my-20">
            <h2 class="h3 text-center w-full mb-4">Nos pains</h2>
            <div class="w-full lg:w-1/3 p-8">
                <img src="{{asset('images/diff_pains.jpg')}}" alt="image 1">
            </div>
            <div class="w-full lg:w-1/3 text-center">
              <p class="text-justify p-8">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg> Le pain de Seigle<br><br>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg> Le pain Complet<br><br>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg> Le pain Viennois<br><br>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg> Le pain aux céréales<br><br>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg> Le pains aux graines<br><br>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg> Le pain de mie<br><br>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg> Le pain de Méteil<br><br>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg> Etc…
              </p>
            </div>
          </div>
          
          <div class="h-auto w-full flex flex-wrap justify-center items-center content-center lg:my-20">
            <h2 class="h3 text-center w-full mb-4 order-1">Les patisseries</h2>
            <div class="w-full text-center order-3 lg:w-1/3  lg:order-2">
              <p class="text-justify p-8">Préparation sucrée de pâte travaillée et cuite au four et/ou dans un moule, de forme et de garniture variées (crème, fruits), le plus souvent destinée à être consommée fraîche, en entremets ou au dessert principalement.
              </p>
              <p class="text-justify p-8">Tarte : Pâtisserie plate, généralement ronde, faite d'un fond de pâte avec rebord rempli de divers ingrédients (fruits, confiture, crème, frangipane, etc.) que l'on cuit au four (sauf certains fruits rouges que l'on met crus sur la pâte cuite) et que l'on consomme généralement refroidie.
              </p>
            </div>
            <div class="w-full order-2 p-8 lg:w-1/3 lg:order-3">
              <img src="{{asset('images/patisserie1.jpg')}}" alt="image 3">
          </div>
          </div>

          {{-- espacement bas --}}
          <div class="h-40">
          </div>




@endsection

{{-- Exemple du caroussel avec texte inclus
<div class="slide">
    <img src="{{asset('images/image5.jpg')}}" alt="">
  <div class="info">
    <h2>Egypt Pyramids</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
  </div>
</div> --}}