<template>
    <div>
        <nav-component/>
        <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
            <div class="col-md-5 p-lg-5 mx-auto my-5">
                <h1 class="display-4 font-weight-normal">Bundles</h1>
                <p class="lead font-weight-normal">And an even wittier subheading to boot. Jumpstart your marketing efforts with this example based on Apple's marketing pages.</p>
                <a class="btn btn-outline-secondary" @click="selectedExchange = 'ZAR'">Change Exchange to Rand</a>
                <a class="btn btn-outline-secondary" @click="selectedExchange = 'EUR'">Change Exchange to Euro</a>
                <a class="btn btn-outline-secondary" @click="selectedExchange = 'USD'">Change Exchange to USD</a>
            </div>
            <div class="product-device box-shadow d-none d-md-block"></div>
            <div class="product-device product-device-2 box-shadow d-none d-md-block"></div>
        </div>
        <div  class="d-md-flex flex-md-equal my-md-3 pl-md-3" :class="calculateWidth(bundles)">
            <div v-for="(value,index) in bundles" :key="index"  :class="calculateColour(index)">
                <div class="my-3 py-3">
                <h2 class="display-5">{{value.name}}</h2>
                <h3 v-if="selectedExchange === 'ZAR'">&#82; {{changeExchange(value.price)}}</h3>
                <h3 v-if="selectedExchange === 'EUR'">&pound; {{changeExchange(value.price)}}</h3>
                <h3 v-if="selectedExchange === 'USD'">&#36; {{changeExchange(value.price)}}</h3>
                <p class="lead" v-html="value.description"></p>
                </div>
                <div class="bg-light box-shadow mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
            </div>
        </div>
        <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
            <div class="col-md-5 p-lg-5 mx-auto my-5">
                <h1 class="display-4 font-weight-normal">Providers</h1>
                <p class="lead font-weight-normal">And an even wittier subheading to boot. Jumpstart your marketing efforts with this example based on Apple's marketing pages.</p>
                <a class="btn btn-outline-secondary" href="#">Coming soon</a>
            </div>
            <div class="product-device box-shadow d-none d-md-block"></div>
            <div class="product-device product-device-2 box-shadow d-none d-md-block"></div>
        </div>
        <div  class="d-md-flex flex-md-equal my-md-3 pl-md-3" :class="calculateWidth(providers)">
            <div v-for="(value,index) in providers" :key="index"  :class="calculateColour(index)">
                <div class="my-3 py-3">
                <h2 class="display-5">{{value.name}}</h2>
                <div v-for="(platform,key) in value.platforms" :key="key">
                    <p>{{platform}}</p>
                </div>
                <p class="lead" v-html="value.description"></p>
                </div>
                <div class="bg-light box-shadow mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
            </div>
        </div>
        <footer-component/>
    </div>
</template>
<script>
import navComponent from './../components/nav.vue';
import footerComponent from './../components/footer.vue';
import axios from 'axios';
export default {
    async mounted(){
        this.bundles = (await axios.get('/api/bundles')).data;
        this.providers = (await axios.get('/api/providers')).data;
        this.exchange = (await axios.get('/api/exchange')).data;
    },
    components:{
        navComponent,
        footerComponent
    },
    data(){
        return {
            bundles:'',
            providers: '',
            exchange: '',
            selectedExchange: 'USD'
        }
    },
    methods:{
        calculateColour(index){
            return index % 2 !== 0 ? 'bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden' : 'bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden'
        },
        calculateWidth(entry){
            if(entry.length === 1){
                return 'w-50'
            }
            return 'w-100'
        },
        changeExchange(price){
            if(this.exchange.rates !== undefined){
            if(this.selectedExchange === 'USD'){
                return  (price * this.exchange.rates['USD'] / Math.pow(10, 2)).toFixed(2);
            }
            if(this.selectedExchange === 'ZAR'){
                return (price * this.exchange.rates[this.selectedExchange] / Math.pow(10, 2)).toFixed(2);
            }
            if(this.selectedExchange === 'EUR'){
                return (price * this.exchange.rates[this.selectedExchange] / Math.pow(10, 2)).toFixed(2);
            }
            }
        },
    }
}
</script>