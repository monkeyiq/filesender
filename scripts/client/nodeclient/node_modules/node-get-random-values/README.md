# node-get-random-values

`crypto.getRandomValues` polyfill for node.

Comes in two flavors, "polyfill" and " phonyfill". The "phonyfill" is a more efficient implementation that doesn't fully correspond to the WebCrypto specification. Specifically, it only implements the code path where the result of the function call is used, e.g.:

```js
const useThis = crypto.getRandomValues(new Uint8Array(16))
```