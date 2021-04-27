<template>
  <div class="container mt-5" data-aos="fade-up" data-aos-duration="1300">
    <section class="search-filiere mx-auto">
      <div class="row m-0 text-center">

            <div class="globalContentCombobox col-lg-3 elementCmbo" id="categories">
                    <span class="optionSelected">Categories</span>
                    <svg width="13" height="13" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-down" class="svg-inline--fa fa-chevron-down fa-w-14 icone-arrow" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path fill="currentColor" d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z"></path>
                    </svg>
                    <div class="contentListCombobox">
                          <span class="itemCombobox" @click="getsubcategories(categorie.id,$event)" v-for="(categorie,index) in categories" :key="categorie.id">{{categorie.name}}</span>
                    </div>
            </div>

            <div class="globalContentCombobox col-lg-3 elementCmbo" v-show='Object.keys(this.subcategories).length'  id="subcategories">
                    <span class="optionSelected">Subcategories</span>
                    <svg width="13" height="13" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-down" class="svg-inline--fa fa-chevron-down fa-w-14 icone-arrow" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                      <path fill="currentColor" d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z"></path>
                    </svg>
                    <div class="contentListCombobox">
                        <span @click='getsubcategoriesProduct(subctg.id,$event)' class="itemCombobox" v-for="subctg in subcategories" :key="subctg.id">{{subctg.name}}</span>
                    </div>
            </div>

              <div class="globalContentCombobox col-lg-3 elementCmbo" id="price">
                      <span class="optionSelected">Price</span>
                      <svg width="13" height="13" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-down" class="svg-inline--fa fa-chevron-down fa-w-14 icone-arrow" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path fill="currentColor" d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z"></path>
                      </svg>
                      <div class="contentListCombobox">
                          <span class="itemCombobox" @click='sortPrice("asc",$event)'>Low to High</span>
                          <span class="itemCombobox" @click='sortPrice("desc",$event)'>High to Low</span>
                      </div>
              </div>

              <div class="contentDleteFiltre col-lg-3 elementCmbo" v-if="showdeleteFilter" @click='deleteFiltre()'>
                  <button  href="#" class="deleteFiltre" tabindex="-1" aria-disabled="true"> <i class="fas fa-times"></i> Effacer les filtres</button>
              </div>
        </div>
    </section>
    <section class="CardFormation" id="products">
        <h2 class="mb-5">Nos Formations</h2>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12" v-for="product in products" :key="product.id" data-aos="zoom-in">
                  <div class="mrg-add mrg-r-add">
                      <a href="#">
                          <div class="card p-3">
                              <img :src="product.image" class="card-img-top" alt="img-product">
                              <div class="card-body">
                                <h6 class="card-title">{{product.name}}</h6>
                                <h5 class="mb-4">{{product.price}}$</h5>
                                <p class="card-text">{{product.description}}</p>
                              </div>
                          </div>
                      </a>
                  </div>
              </div>
          </a>
        </div>
    </section>
  </div>
</template>

<script>
export default {
    data () {
      return {
        categories : {},
        products : {},
        productToEmpty : {},
        subcategories : {},
        showdeleteFilter : false,
        activeSort : null,
        categorie_id : "",
        subcategories_id : "",
      }
    },
    methods : {
      getCategories () {
            axios.get('/api/categories')
                 .then(response => this.categories = response.data)
                 .catch(error => console.log(error));
      },
      getProducts () {
            axios.get('/api/products')
                 .then(response => {
                      this.products = response.data
                  })
                  .catch(error => console.log(error));
      },

      getsubcategories(id,event){
            this.categorie_id = 'categorie_' + id;
            this.subcategories_id = "";
            axios.get('/api/subcategories/'+id)
                 .then(response => {
                   this.subcategories = response.data
                   if(Object.keys(this.subcategories).length){
                       document.querySelector('#subcategories .optionSelected').innerHTML = 'Subcategories';
                   }
                 })
                 .catch(error => console.log(error));

            document.querySelector('#categories .optionSelected').innerHTML = event.target.innerHTML;

            this.showdeleteFilter = true;
            axios.get('/api/productByCategorie/'+id+'/'+this.activeSort)
                 .then(response => {
                      this.products = response.data
                  })
                .catch(error => console.log(error));
      },

      getsubcategoriesProduct(id,event) {
            this.subcategories_id = 'subcategorie_' + id;
            axios.get('/api/subcategoriesProduct/'+id+'/'+this.activeSort)
                 .then(response => this.products = response.data)
                 .catch(error => console.log(error));

            document.querySelector('#subcategories .optionSelected').innerHTML = event.target.innerHTML;
      },

      sortPrice (element,event) {
          var elementToSend = null;
          if(this.subcategories_id != ''|| this.categorie_id != ''){
              if(this.subcategories_id != ''){
                  elementToSend = this.subcategories_id;
              }else{
                  elementToSend = this.categorie_id;
              }
          }else{
            elementToSend = "null";
          }

          console.log(this.subcategories_id);

          axios.get('/api/sortByPrice/'+element+'/'+elementToSend)
               .then(response => {
                 this.products = response.data
                 this.activeSort = element
               })
               .catch(error => console.log(error));
                this.showdeleteFilter = true;
               document.querySelector('#price .optionSelected').innerHTML = event.target.innerHTML;

      },

      deleteFiltre() {
         document.querySelector('#categories .optionSelected').innerHTML = 'Categories';
         document.querySelector('#price .optionSelected').innerHTML = 'Price';
         this.showdeleteFilter = false;
         this.categorie_id = '';
         this.subcategories_id = '';
         this.activeSort = null;
         this.subcategories = {};
         this.getProducts ();
      }

    },
    mounted() {
      this.getCategories();
      this.getProducts();
    }
}
</script>
<style src="../../css/CategoriesProdcuts.css"></style>
