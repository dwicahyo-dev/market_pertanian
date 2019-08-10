<template>
  <div class=" col-12">
    <form
      class="form-horizontal"
      id="donation"
      @submit.prevent="onSubmit()"
    >

      <!-- Form Name -->
      <legend>Donation</legend>

      <div class="row">
        <div class="col-md-4">

          <!-- Text input-->
          <div class="form-group">
            <label
              class="control-label"
              for="donor_name"
            >Donor Name</label>
            <div>
              <input
                id="donor_name"
                name="donor_name"
                type="text"
                placeholder="Enter your name.."
                class="form-control input-md"
                required
                v-model="donor_name"
              >

            </div>
          </div>

        </div>

        <div class="col-md-4">

          <!-- Text input-->
          <div class="form-group">
            <label
              class="control-label"
              for="donor_email"
            >Donor Email</label>
            <div>
              <input
                id="donor_email"
                name="donor_email"
                type="text"
                placeholder="Enter your email.."
                class="form-control input-md"
                required
                v-model="donor_email"
              >

            </div>
          </div>

        </div>

        <div class="col-md-4">

          <!-- Select Basic -->
          <div class="form-group">
            <label
              class="control-label"
              for="donation_type"
            >Type</label>
            <div>
              <select
                id="donation_type"
                name="donation_type"
                class="form-control"
                required
                v-model="donation_type"
              >
                <option value="infak_kemanusiaan">Infak Kemanusiaan</option>
                <option value="infak_pendidikan">Infak Pendidikan</option>
                <option value="infak_kesehatan">Infak Kesehatan</option>
              </select>
            </div>
          </div>

        </div>
      </div>

      <div class="row">
        <div class="col-md-6">

          <!-- Prepended text-->
          <label for="">Amount</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span
                class="input-group-text"
                id="basic-addon1"
              >Rp</span>
            </div>
            <input
              id="amount"
              name="amount"
              class="form-control"
              placeholder=""
              type="number"
              min="10000"
              max="999999999"
              required
              v-model="amount"
            >
          </div>

        </div>
        <div class="col-md-6">

          <!-- Textarea -->
          <div class="form-group">
            <label
              class="control-label"
              for="note"
            >Note (Optional)</label>
            <div>
              <textarea
                class="form-control"
                id="note"
                name="note"
              ></textarea>
            </div>
          </div>

        </div>
      </div>

      <button
        id="submit"
        class="btn btn-success"
      >Submit</button>

    </form>
  </div>
</template>

<script>
  export default {
    mounted() {
      console.log("Component mounted.");
    },
    data() {
      return {
        donor_name: "",
        donor_email: "",
        donation_type: "",
        amount: ""
      };
    },
    methods: {
      onSubmit() {
        axios
          .post(location.origin + `/donation/store`, {
            donor_name: this.donor_name,
            donor_email: this.donor_email,
            donation_type: this.donation_type,
            amount: this.amount
          })
          .then(response => {
            console.log(response);

            snap.pay(response.data.snap_token, {
              onSuccess: function(result) {
                console.log("success");
                console.log(result);
              },
              onPending: function(result) {
                console.log("pending");
                console.log(result);
              },
              onError: function(result) {
                console.log("error");
                console.log(result);
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
