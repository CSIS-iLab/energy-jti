chmod 600 /tmp/csisjti_rsa
eval "$(ssh-agent -s)" # Start the ssh agent
ssh-add /tmp/csisjti_rsa
git remote add csisjti-staging git@git.wpengine.com:production/csisjtistaging.git # add remote for staging site
git fetch --unshallow # fetch all repo history or wpengine complain
git status # check git status
git checkout master # switch to master branch
git add wp-content/themes/csisjti/*.css -f # force all compiled CSS files to be added
git add wp-content/themes/csisjti/assets -f # force all compiled JS & optimized images
git commit -m "Compiled & bundled all assets" # commit the compiled CSS files
git push -f csisjti-staging master #deploy to staging site from master
