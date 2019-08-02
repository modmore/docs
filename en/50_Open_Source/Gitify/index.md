[Gitify](https://github.com/modmore/Gitify/) is a set of command-line commands that can be used for versioning and dev-stage-production workflows with a MODX site. Its primary purpose is to create file representations of objects in the MODX database (such as resources and elements, but any object can be included), so they can be committed to a version control system such as git.

The project configuration, which determines what data is written to file and build to the database, is stored in a [.gitify file](dot-gitify) in the project root.

[Gitify Watch](https://modmore.com/gitifywatch/) is a free companion MODX Extra for Gitify, which will automatically extract information from MODX when changes are made. 

Gitify was first introduced at the MODX Weekend 2014. [A video of that talk is available here](https://video.modmore.com/modx-weekend-2014/sunday-backend/staging-workflow-with-git-and-gitify/). [Slides of the MODXpo 2015 talk can be found here](http://www.slideshare.net/hamstramark1/dev-staging-production-workflow-with-gitify-at-modxpo-2015-in-munich), which walks you through the purpose of Gitify and how the process can be set up.