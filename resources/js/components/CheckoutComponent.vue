<template>
  <div>
    <section class="section">
      <div class="section-header">
        <div class="section-header-back">
          <a
            :href="`${url.back}`"
            class="btn btn-icon"
          >
            <i class="fas fa-arrow-left"></i>
          </a>
        </div>
        <h1>Checkout</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item"><a :href="url.dashboard">Dashboard</a></div>
          <div class="breadcrumb-item"><a :href="url.back">Daftar Keranjang Belanja</a></div>
          <div class="breadcrumb-item">Checkout</div>
        </div>
      </div>

      <div class="section-body">
        <form @submit.prevent="onSubmit()">
          <div class="row">
            <div class="col-12 col-sm-7 col-md-7 col-lg-7">
              <div class="card">
                <div class="card-header">
                  <h4>Alamat Pengiriman</h4>
                </div>
                <div class="card-body">
                  <div v-if="selected.address.id">
                    <h4 v-text="show.address.name_of_recipient"></h4>
                    <p
                      class="card-text"
                      v-text="show.address.phonenumber"
                    ></p>
                    <p v-text="show.address.full_address"></p>
                    <p class="card-text"> {{ show.address.city.type }}
                      {{ show.address.city.city_name }}, {{ show.address.city.province }} : {{ show.address.city.postal_code }}
                    </p>
                  </div>
                  <div v-else>
                    <p>Pilih Alamat Pengiriman terlebih dahulu</p>
                  </div>
                </div>
                <div class="card-footer bg-whitesmoke">
                  <div class="float-left">
                    <a
                      :href="url.addAddress"
                      class="btn btn-danger"
                    >Tambah Alamat</a>
                  </div>

                  <div class="float-right">
                    <button
                      type="button"
                      class="btn btn-primary"
                      data-toggle="modal"
                      data-target="#selectAddressModal"
                    >
                      Pilih Alamat Lain
                    </button>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h4>Layanan Pengiriman</h4>
                    </div>
                    <div class="card-body">
                      <div class="form-group ">
                        <label>Kurir</label>
                        <select
                          class="form-control"
                          v-model="selected.courrier.value"
                          v-bind:disabled="!selected.address.city_id"
                          @change="shipping()"
                        >
                          <option value="">-- Pilih Kurir --</option>
                          <option
                            v-for="courrier in courriers"
                            :key="courrier.index"
                            :value="courrier.value"
                          > {{ courrier.text }}
                          </option>
                        </select>
                      </div>

                      <div class="form-group ">
                        <label>Layanan</label>
                        <select
                          class="form-control"
                          v-model="selected.cost"
                          v-bind:disabled="!selected.courrier.value"
                        >
                          <option value="">-- Pilih Layanan --</option>
                          <option
                            v-for="service in cost.results.costs"
                            :key="service.index"
                            :value="{ service: service.service, description: service.description, cost: service.cost['0'].value, etd: service.cost['0'].etd }"
                          > {{ service.service }} - {{ service.cost['0'].value | currency }} ({{ service.cost['0'].etd | estimate }})
                          </option>
                        </select>
                        <span v-show="selected.cost.description">{{ selected.cost.description }} - Estimasi Pengiriman : {{ selected.cost.etd | estimate }}</span> <br>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <div class="col-12 col-sm-5 col-md-5 col-lg-5">
              <div class="card">
                <div class="card-header">
                  <h4>Ringkasan Belanja</h4>
                </div>
                <div class="card-body">
                  <ul class="list-group">
                    <li class=" d-flex justify-content-between align-items-center">
                      Total Harga ({{ cartData.data.qty }} kg)
                      <h6>{{ totalProductPrice | currency }}</h6>
                    </li>
                    <div v-if="selected.address">
                      <li class=" d-flex justify-content-between align-items-center">
                        Total Ongkos Kirim
                        <h6>{{ selected.cost.cost | currency }}</h6>
                      </li>
                    </div>
                  </ul>

                  <hr>

                  <ul class="list-group">
                    <li class="d-flex justify-content-between align-items-center">
                      Total Tagihan
                      <h6>{{ totalPrice | currency }}</h6>
                    </li>
                  </ul>

                  <ul class="list-group">
                    <li class="d-flex justify-content-between align-items-center">
                      Estimasi Pengiriman
                      <h6>{{ selected.cost.etd | estimate }}</h6>
                    </li>
                  </ul>

                  <br>

                  <button
                    :disabled="!selected.cost"
                    type="submit"
                    class="btn btn-block btn-primary"
                  >Bayar Sekarang</button>

                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">{{ cartData.data.product.product_name }}</h4>
                      <span class="badge badge-primary">Kualitas {{ cartData.data.product.quality.quality_name }}</span>
                      <span class="badge badge-secondary">Komoditas {{ cartData.data.product.agriculture.commodity.commodity_name }}</span>
                      <span class="badge badge-danger">{{ cartData.data.product.price | currency }}</span>

                      <div class="form-group mt-3">
                        <label>Catatan untuk Penjual (Opsional)</label>
                        <input
                          type="text"
                          class="form-control"
                          v-model="cartData.data.seller_note"
                          v-text="cartData.data.seller_note"
                          placeholder="Catatan Untuk Penjual"
                        >
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>

    </section>

    <!-- Select Address Modal -->
    <div
      class="modal fade"
      id="selectAddressModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div
        class="modal-dialog modal-lg"
        role="document"
      >
        <div class="modal-content">
          <div class="modal-header">
            <h5
              class="modal-title"
              id="exampleModalLabel"
            >Pilih Alamat Pengiriman
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div v-if="!addressesData.data.length">
              <div class="card">
                <div class="card-body bg-danger">
                  <h4 class="card-title text-white m-auto">Opps, alamat kosong. Tambahkan alamat pengiriman.</h4>
                </div>
              </div>
            </div>
            <div v-else>
              <div
                v-for="address in addressesData.data"
                :key="address.id"
                :value="address.city.id"
              >
                <div class="card border border-primary">
                  <div class="card-body">
                    <h4 class="card-title">{{ address.name_of_recipient }}</h4>
                    <p
                      class="card-text"
                      v-text="address.phonenumber"
                    ></p>
                    <p v-text="address.full_address"></p>
                    <p class="card-text"> {{ address.city.type }} {{ address.city.city_name }}, {{ address.city.province }} : {{ address.city.postal_code }}</p>
                    <div class="float-right">
                      <button
                        type="button"
                        class="btn btn-primary"
                        data-dismiss="modal"
                        @click="selectAddress(address.id, address.city.id)"
                      >Pilih Alamat</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
  export default {
    props: ["cart", "addresses"],
    computed: {
      totalProductPrice() {
        return this.cartData.data.qty * this.cartData.data.product.price;
      },
      totalPrice() {
        return this.totalProductPrice + this.selected.cost.cost;
      },
      weight() {
        return this.cartData.data.qty * 1000;
      },
    },
    filters: {
      estimate(value) {
        if (!value) return '';
        let str = value.endsWith('HARI');
        return str ? value : value + ' HARI';
      }
    },
    data() {
      return {
        cartData: {
          data: this.cart
        },
        addressesData: {
          data: this.addresses
        },
        courriers: [
          { text: "JNE", value: "jne" },
          { text: "TIKI", value: "tiki" },
          { text: "POS Indonesia", value: "pos" }
        ],
        selected: {
          address: {
            id: "",
            city_id: ""
          },
          courrier: {
            value: ""
          },
          service: {
            code: "",
            name: "",
            value: ""
          },
          cost: ""
        },
        show: {
          address: {},
          city: {}
        },
        cost: {
          destination_details: {},
          origin_details: {},
          query: {},
          results: {}
        },
        url: {
          back: location.origin + "/carts",
          addAddress: location.origin + "/addresses",
          dashboard: location.origin + "/"
        }
      };
    },
    methods: {
      selectAddress(id, city_id) {
        this.selected.address.id = id;
        this.selected.address.city_id = city_id;
        this.showSelectedAddress(id);

        this.selected.courrier.value = "";
        this.selected.cost = "";

        this.setCostEmpty();
      },
      showSelectedAddress(id) {
        axios.get(location.origin + "/addresses/" + id).then(response => {
          this.show.address = response.data.address;
          this.show.city = response.data.city;
        });
      },
      async shipping() {
        this.selected.cost = "";

        await axios
          .get(
            location.origin +
              "/shipping/" +
              `${this.cartData.data.product.store.city_id}/${
                this.selected.address.city_id
              }/${this.weight}/${this.selected.courrier.value}`
          )
          .then(response => {
            let destination_details = response.data.destination_details;
            let origin_details = response.data.origin_details;
            let query = response.data.query;
            let results = response.data.results;

            let error_description;

            if(results.costs.length == 0){
              this.setAlertDialogService('Layanan pengiriman tidak ditemukan. Silahkan pilih Kurir atau Alamat lain.');
            }

            if (!response.data.error_description) {
              this.setCost(destination_details, origin_details, query, results);
            } else {
              error_description = response.data.error_description;
              this.setAlertDialog(error_description);
            }
          });
      },
      setAlertDialog(message) {
        this.$swal({
          title: "Oops...",
          text: message,
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ubah disini..",
          cancelButtonText: "OK"
        }).then(result => {
          if (result.value) {
            location.href = "edit";
          }
        });
      },
      setAlertDialogService(message) {
        this.$swal({
          title: "Oops...",
          text: message,
          type: "warning",
          cancelButtonText: "OK"
        });
      },
      setCost(destination_details, origin_details, query, results) {
        this.cost.destination_details = destination_details;
        this.cost.origin_details = origin_details;
        this.cost.query = query;
        this.cost.results = results;

        this.selected.service.code = results.code;
        this.selected.service.name = results.name;
      },
      setCostEmpty() {
        this.cost.destination_details = {};
        this.cost.origin_details = {};
        this.cost.query = {};
        this.cost.results = {};
      },
      onSubmit() {
        let shopping_cart_id = this.cartData.data.id;

        axios
          .post(`${location.origin}/checkout/storeSnap`, {
            amount: this.totalPrice,
            customer_name: this.cartData.data.user.name,
            customer_email: this.cartData.data.user.email,
            customer_phone: this.show.address.phonenumber,
            customer_address: this.show.address.full_address,
            product_name: this.cartData.data.product.product_name
          })
          .then(response => {
            let snap_token = response.data.snap_token;
            let shopping_cart_id = this.cartData.data.id;

            let thumbnail = this.cart.product.thumbnail;
            let product_real_id = this.cart.product_id;
            let total_price = this.totalPrice;

            let qty = this.cartData.data.qty;
            let seller_note = this.cartData.data.seller_note;

            let courrier_code = this.selected.service.code;
            let courrier_name = this.selected.service.name;
            let service = this.selected.cost.service;
            let service_description = this.selected.cost.description;
            let service_value = this.selected.cost.cost;
            let etd = this.selected.cost.etd;

            let agriculture_id = this.cartData.data.product.agriculture_id;
            let quality_id = this.cartData.data.product.quality_id;
            let product_name = this.cartData.data.product.product_name;
            let store_id = this.cartData.data.product.store_id;
            let price = this.cartData.data.product.price;
            let stock = this.cartData.data.product.stock;
            let description = this.cartData.data.product.description;

            // Address History
            let city_id = this.show.address.city_id;
            let name_of_recipient = this.show.address.name_of_recipient;
            let phonenumber = this.show.address.phonenumber;
            let full_address = this.show.address.full_address;

            snap.pay(snap_token, {
              onSuccess: function(result) {
                console.log("success");
                // console.log(result);

                axios
                  .post(`${location.origin}/checkout/store`, {
                    total_price: total_price,
                    shopping_cart_id: shopping_cart_id,
                    product_real_id: product_real_id,
                    thumbnail: thumbnail,

                    qty: qty,
                    seller_note: seller_note,
                    order_id: result.order_id,

                    courrier_code: courrier_code,
                    courrier_name: courrier_name,
                    service: service,
                    service_description: service_description,
                    service_value: service_value,
                    etd: etd,

                    approval_code: result.approval_code,
                    bank: result.bank,
                    card_type: result.card_type,
                    bill_key: result.bill_key,
                    biller_code: result.biller_code,
                    finish_redirect_url: result.finish_redirect_url,
                    fraud_status: result.fraud_status,
                    gross_amount: result.gross_amount,
                    masked_card: result.masked_card,
                    order_id: result.order_id,
                    payment_type: result.payment_type,
                    redirect_url: result.redirect_url,
                    pdf_url: result.pdf_url,
                    status_code: result.status_code,
                    status_message: result.status_message,
                    transaction_id: result.transaction_id,
                    transaction_status: result.transaction_status,
                    transaction_time: result.transaction_time,

                    agriculture_id: agriculture_id,
                    quality_id: quality_id,
                    product_name: product_name,
                    store_id: store_id,
                    price: price,
                    stock: stock,
                    description: description,

                    city_id: city_id,
                    name_of_recipient: name_of_recipient,
                    phonenumber: phonenumber,
                    full_address: full_address
                  })
                  .then(result => {
                    window.location.href = result.data.finish_redirect_url;
                  });
              },
              onPending: function(result) {
                console.log("pending");
                // console.log(result);

                axios
                  .post(`${location.origin}/checkout/store`, {
                    total_price: total_price,
                    shopping_cart_id: shopping_cart_id,
                    product_real_id: product_real_id,
                    thumbnail: thumbnail,

                    qty: qty,
                    seller_note: seller_note,
                    order_id: result.order_id,

                    courrier_code: courrier_code,
                    courrier_name: courrier_name,
                    service: service,
                    service_description: service_description,
                    service_value: service_value,
                    etd: etd,

                    approval_code: result.approval_code,
                    bank: result.bank,
                    card_type: result.card_type,
                    bill_key: result.bill_key,
                    biller_code: result.biller_code,
                    finish_redirect_url: result.finish_redirect_url,
                    fraud_status: result.fraud_status,
                    gross_amount: result.gross_amount,
                    masked_card: result.masked_card,
                    order_id: result.order_id,
                    payment_type: result.payment_type,
                    redirect_url: result.redirect_url,
                    pdf_url: result.pdf_url,
                    status_code: result.status_code,
                    status_message: result.status_message,
                    transaction_id: result.transaction_id,
                    transaction_status: result.transaction_status,
                    transaction_time: result.transaction_time,

                    agriculture_id: agriculture_id,
                    quality_id: quality_id,
                    product_name: product_name,
                    store_id: store_id,
                    price: price,
                    stock: stock,
                    description: description,

                    city_id: city_id,
                    name_of_recipient: name_of_recipient,
                    phonenumber: phonenumber,
                    full_address: full_address
                  })
                  .then(result => {
                    // console.log(result);

                    window.location.href = result.data.finish_redirect_url;
                  });
              },
              onError: function(result) {
                console.log("error");
                // console.log(result);
              },
              onClose: function() {
                console.log(
                  "customer closed the popup without finishing the payment"
                );
              }
            });
          });
      }
    }
  };
</script>
