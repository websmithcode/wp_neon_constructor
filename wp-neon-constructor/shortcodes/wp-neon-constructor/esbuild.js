// esbuild sctipt (type=module)

import { build } from 'esbuild';

build({
  entryPoints: ['src/index.js'],
  bundle: true,
  outfile: 'public/main.js',
  format: 'esm',
  minify: true,
  sourcemap: true,
  logLevel: 'info',
  incremental: true,
  watch: true,
}).catch(() => process.exit(1));

