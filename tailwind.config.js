import preset from './vendor/filament/support/tailwind.config.preset'

export default {
    presets: [
        preset,
        require('./vendor/wireui/wireui/tailwind.config.js')
    ],
    content: [
        './app/Filament/**/*.php',
        './resources/views/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        "./node_modules/flowbite/**/*.js",
        './vendor/wireui/wireui/resources/**/*.blade.php',
        './vendor/wireui/wireui/ts/**/*.ts',
        './vendor/wireui/wireui/src/View/**/*.php'
    ],
    plugins: [
        require('flowbite/plugin')
    ],
}
