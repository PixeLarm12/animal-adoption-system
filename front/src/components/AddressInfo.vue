<template>
    <div class="col-span-12 w-11/12 justify-start items-center text-left flex-wrap gap-x-10 grid grid-cols-12 place-content-center place-items-center">
        <div class="col-span-12 w-11/12 flex justify-start items-center text-left flex-wrap gap-x-10">
            <h3 class="text-default-gray font-bold text-lg">Addresses</h3>

            <span @click="showAddress = !showAddress" class="w-3/12 default-input-array-button">{{ getAddressesTitle }}</span>
        </div>

        <div v-if="showAddress" class="col-span-12 w-11/12 flex justify-start items-center text-left flex-wrap">
            <div class="w-full grid grid-cols-12 place-content-center place-items-center gap-4 py-5">
                <div class="col-span-9 w-full flex justify-start items-center text-left flex-wrap">
                    <label for="address-street" class="text-default-gray font-bold text-lg">Street <span class="text-xl text-red-600 font-bold">*</span></label>
                    <input v-model="tempAddress.street" type="address-street" name="address-street" id="address-street" placeholder="Type your address' street" class="default-input">
                </div>

                <div class="col-span-3 w-full flex justify-start items-center text-left flex-wrap">
                    <label for="address-number" class="text-default-gray font-bold text-lg">Number <span class="text-xl text-red-600 font-bold">*</span></label>
                    <input v-model="tempAddress.number" type="address-number" name="address-number" id="address-number" placeholder="Type your address' number" class="default-input">
                </div>

                <div class="col-span-12 lg:col-span-6 w-full flex justify-start items-center text-left flex-wrap">
                    <label for="address-zipcode" class="text-default-gray font-bold text-lg">Zipcode <span class="text-xl text-red-600 font-bold">*</span></label>
                    <input v-model="tempAddress.zipcode" type="address-zipcode" name="address-zipcode" id="address-zipcode" placeholder="Type your address' zipcode" class="default-input">
                </div>

                <div class="col-span-12 lg:col-span-6 w-full flex justify-start items-center text-left flex-wrap">
                    <label for="address-neighborhood" class="text-default-gray font-bold text-lg">Neighborhood <span class="text-xl text-red-600 font-bold">*</span></label>
                    <input v-model="tempAddress.neighborhood" type="address-neighborhood" name="address-neighborhood" id="address-neighborhood" placeholder="Type your address' neighborhood" class="default-input">
                </div>

                <div class="col-span-12 w-full flex justify-start items-center text-left flex-wrap">
                    <label for="address-complement" class="text-default-gray font-bold text-lg">Complement</label>
                    <input v-model="tempAddress.complement" type="address-complement" name="address-complement" id="address-complement" placeholder="Type your address' complement" class="default-input">
                </div>

                <div class="col-span-12 w-full flex flex-row justify-end items-end self-end text-left">
                    <span @click="addAddress" class="w-2/12 default-input-array-button">+ address</span>
                </div>
            </div>

            <input-array-component-template v-if="addresses.length > 0" :headers="addressHeaders">
                <tr v-for="(address, index) in addresses" :key="index" class="w-full border border-gray-400 divide-x-2 divide-gray-400">
                    <td class="lg:pl-3 pl-1 h-5 w-4/12">
                        {{ (index+1) }}
                    </td>
                    <td class="lg:pl-3 pl-1 h-5 w-6/12">
                        {{ address.zipcode }}
                    </td>
                    <td class="lg:pl-3 pl-1 h-5 w-6/12">
                        {{ address.street }}, {{ address.number }}
                    </td>
                    <td class="lg:pl-3 pl-1 h-5 w-6/12">
                        <span @click="removeAddress(address)" class="hover:underline text-red-500 uppercase">Remove</span>
                    </td>
                </tr>  
            </input-array-component-template>

            <span v-else class="text-lg text-red-500">The user does not have address added.</span>
        </div>
    </div>
</template>

<script>
import InputArrayComponentTemplate from './Utils/InputArrayComponentTemplate.vue'

export default {
    components: {
        InputArrayComponentTemplate
    },
    computed: {
        getAddressesTitle() {
            return this.showAddress ? 'Clear Addresses' : 'Show Addresses';
        },
    },
    watch: {
        showAddress(oldVal, newVal) {
            if((oldVal == false && newVal == true) && !this.$route.params.id) {
                this.tempAddress = {
                    street: '',
                    number: '',
                    zipcode: '',
                    neighborhood: '',
                    complement: '',
                };

                this.$emit('update-address', []);
            }
        },
    },
    props: {
        addresses: {
            type: Array,
            required: true,
            default: () => []
        }
    },
    data() {
        return {
            showAddress: false,
            addressHeaders: [
                "Index",
                "Zipcode",
                "Address",
                "Delete"
            ],
            tempAddress: {
                street: '',
                number: '',
                zipcode: '',
                neighborhood: '',
                complement: '',
            },
        }
    },
    methods: {
        addAddress() {
            if(this.tempAddress.street !== '' && this.tempAddress.number !== '' && this.tempAddress.zipcode !== '' && this.tempAddress.neighborhood !== '') {
                const newAddress = {
                    street: this.tempAddress.street,
                    number: this.tempAddress.number,
                    zipcode: this.tempAddress.zipcode,
                    neighborhood: this.tempAddress.neighborhood,
                    complement: this.tempAddress.complement,
                };

                const newAddresses = [...this.addresses, newAddress];

                this.tempAddress = {
                    street: '',
                    number: '',
                    zipcode: '',
                    neighborhood: '',
                    complement: '',
                };

                this.$emit('update-address', newAddresses);
            }
        },

        removeAddress(object) {
            const newAddresses = this.addresses.filter(el => el.zipcode !== object.zipcode);
            
            this.$emit('update-address', newAddresses);
        },
    }
}
</script>
