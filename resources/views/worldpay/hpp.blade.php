<!DOCTYPE html>
<html>
    <head>
        <title>Payment Page</title>
        <style>
            body {
              font: 11px/22px sans-serif;
              text-transform: uppercase;
              background-color: #f7f7f7;
              color: black;
            }
            
            .container {
              height: 100vh;
              display: flex;
              justify-content: center;
              align-items: center;
            }
            
            .card {
              position: relative;
              background: white;
              padding: 40px 30px;
              top: -30px;
              width: 100%;
              max-width: 300px;
              border-radius: 12px;
              box-shadow: 3px 3px 60px 0px rgba(0, 0, 0, 0.1);
            }
            .card .checkout .col-2 {
              display: flex;
            }
            .card .checkout .col-2 .col:first-child {
              margin-right: 15px;
            }
            .card .checkout .col-2 .col:last-child {
              margin-left: 15px;
            }
            .card .checkout .label .type {
              color: green;
            }
            .card .checkout.visa .label .type:before {
              content: "(visa)";
            }
            .card .checkout.mastercard .label .type:before {
              content: "(master card)";
            }
            .card .checkout.amex .label .type:before {
              content: "(american express)";
            }
            .card .checkout .field {
              height: 40px;
              border-bottom: 1px solid lightgray;
            }
            .card .checkout .field#card-pan {
              margin-bottom: 30px;
            }
            .card .checkout .field.is-onfocus {
              border-color: black;
            }
            .card .checkout .field.is-empty {
              border-color: orange;
            }
            .card .checkout .field.is-invalid {
              border-color: red;
            }
            .card .checkout .field.is-valid {
              border-color: green;
            }
            .card .checkout .submit {
              background: red;
              position: absolute;
              cursor: pointer;
              left: 50%;
              bottom: -60px;
              width: 200px;
              margin-left: -100px;
              color: white;
              outline: 0;
              font-size: 14px;
              border: 0;
              border-radius: 30px;
              text-transform: uppercase;
              font-weight: bold;
              padding: 15px 0;
              transition: background 0.3s ease;
            }
            .card .checkout.is-valid .submit {
              background: green;
            }
            
            .clear {
              background: grey;
              position: absolute;
              cursor: pointer;
              left: 50%;
              bottom: -120px;
              width: 200px;
              margin-left: -100px;
              color: white;
              outline: 0;
              font-size: 14px;
              border: 0;
              border-radius: 30px;
              text-transform: uppercase;
              font-weight: bold;
              padding: 15px 0;
              transition: background 0.3s ease;
            }
        </style>
    </head>

    <body>
        <section class="container">
    <section class="card">
        <form class="checkout" id="card-form">
            <div class="label">Card number <span class="type"></span></div>
            <section id="card-pan" class="field"></section>
            <section class="col-2">
                <section class="col">
                    <div class="label">Expiry date</div>
                    <section id="card-expiry" class="field"></section>
                </section>
                <section class="col">
                    <div class="label">CVV</div>
                    <section id="card-cvv" class="field"></section>
                </section>
            </section>
            <button class="submit" type="submit">Pay Now</button>
        </form>
        <button class="clear" id="clear">Clear</button>
    </section>
</section>

<script src="https://try.access.worldpay.com/access-checkout/v2/checkout.js"></script>
<script>
    (function () {
  var form = document.getElementById("card-form");
  var clear = document.getElementById("clear");
  Worldpay.checkout.init(
    {
      id: "",
      form: "#card-form",
      fields: {
        pan: {
          selector: "#card-pan",
          placeholder: "4000000000002701"
        },
        expiry: {
          selector: "#card-expiry",
          placeholder: "12/35"
        },
        cvv: {
          selector: "#card-cvv",
          placeholder: "831"
        }
      },
      styles: {
        "input": {
          "color": "black",
          "font-weight": "bold",
          "font-size": "20px",
          "letter-spacing": "3px"
        },
        "input#pan": {
          "font-size": "24px"
        },
        "input.is-valid": {
          "color": "green"
        },
        "input.is-invalid": {
          "color": "red"
        },
        "input.is-onfocus": {
          "color": "black"
        }
      },
      accessibility: {
        ariaLabel: {
          pan: "my custom aria label for pan input",
          expiry: "my custom aria label for expiry input",
          cvv: "my custom aria label for cvv input"
        },
        lang: {
          locale: "en-GB"
        },
        title: {
          enabled: true,
          pan: "my custom title for pan",
          expiry: "my custom title for expiry date",
          cvv: "my custom title for security code"
        }
      },
      acceptedCardBrands: ["amex", "diners", "discover", "jcb", "maestro", "mastercard", "visa"],
      enablePanFormatting: true
    },
    function (error, checkout) {
      if (error) {
        console.error(error);
        return;
      }

      form.addEventListener("submit", function (event) {
        event.preventDefault();

        checkout.generateSessionState(function (error, sessionState) {
          if (error) {
            console.error(error);
            return;
          }

          // session state for card details
          alert(sessionState);
        });
      });

      clear.addEventListener("click", function(event) {
        event.preventDefault();
        checkout.clearForm(function() {
          // trigger desired behaviour on cleared form
          console.log('Form successfully cleared');
        });
      });
    }
  );
})();
</script>

// For production change to "https://access.worldpay.com/access-checkout/v2/checkout.js"
    </body>
</html>
