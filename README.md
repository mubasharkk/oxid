# Oxid Coding Challenge

## 2. CURRENCY CONVERTER
<details>
<summary>Description</summary>

You need to design a simple converter which accepts a monetary value in a certain currency as an argument and outputs
list of results converted to various world currencies (requested currencies and exchange rates will come from a data
source).

Data source for currencies and exchange rates (for now data is in JSON, but you've already heard that soon you'll need
to switch to CSV or XML so make the switch as easy as possible):

```json
{
  "baseCurrency": "EUR",
  "exchangeRates": {
    "EUR": 1,
    "USD": 5,
    "CHF": 0.97,
    "CNY": 2.3
  }
}
```

The output (list of results) should be in JSON or CVS format (might change in the future). Possible interface for the
converter, it’s just an example, feel free to improve, modify it or define your own:

```php
interface CurrencyConverterInterface
{ 
    public function convert(float $amount, Currency $currency): string;
}
```
</details>


## Technical Notes

Following are the technical & architectural notes:

* The code is structure into 3 main components
  * **Configurators:** This component is responsible for reading configuration from a given data source and make it transferable/processable for the services component.
    * Available data sources are `.json`, `.csv`, `.xml` (only json is implemented, as other data sources are assumed to be "not yet defined", though placeholder classes are added).
    * Additionally, an external API by https://app.freecurrencyapi.com is used as a data source (implemented already).
    * Not implemented as TDD as I had to figure out before how to design the application first.
    * **File:** 
      * [src/Config/ExchangeRatesConfigFactory](https://github.com/mubasharkk/oxid/blob/master/src/Config/ExchangeRatesConfigFactory.php)
      * [src/Config/From/ApiExchangeRates](https://github.com/mubasharkk/oxid/blob/master/src/Config/From/ApiExchangeRates.php)
      * [src/Config/From/JsonExchangeRates](https://github.com/mubasharkk/oxid/blob/master/src/Config/From/ApiExchangeRates.php)
  * **Services:** This component is responsible for currency conversion logic and the calculations to be done for the application.
    * Implemented using TDD.
    * **File:**
        * [src/Services/CurrencyConverter](https://github.com/mubasharkk/oxid/blob/master/src/Services/CurrencyConverter.php)
  * **Renderer:** This component is only responsible for rendering the resultant data into various format. 
    * **File:**
        * [src/Renderer/OutputRenderer](https://github.com/mubasharkk/oxid/blob/master/src/Renderer/OutputRenderer.php)

**Note:** Some additional comments are added to the code itself for further explanations. There is still room for optimization but tried not to stuck into a refactoring spiral.

### Files


### Setup & Execution

```console
composer install
php index.php
```

### Running Tests

```console
./vendor/bin/phpunit tests/ --colors
```

**GitHub Workflow** is also added for phpunit, [**view here**](https://github.com/mubasharkk/oxid/blob/master/.github/workflows/ci.yml]).