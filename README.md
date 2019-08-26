# SpartanCMS
Thanks for checking this out. Please read this entire document if you intend to experiment with this.

# **IMPORTANT NOTE**
### ***There is currently no user-management system*** so you should not use this in a public environment as of right now.

## What it is
The simplest possible blog/cms thing I can possibly come up with.

### What it can do right now
- Fully-functional installer script to ease experimentation and development on new platforms.
- Allows creation, editing, and deletion of posts with search and category tags.
- Alows creation, editing, and deletion of post categories.
- Allows for the creation of comments on posts, with a per-post ability to disable comments and all comments requiring approval by the admin.

### What's on the docket
- Completion of comments functionality (deletion, admin management). 
- User management. As mentioned above there is no user system in place, so admin is open to _everyone_ that can hit your install of this page from an admin perspective. ***I cannot stress enough that you do not use this in a live environment if you download it. Install XAMPP or restirct the installation directory to your IP only***
- Code reorganization. Right now code is scattered throughout all files and is likely fairly insecure. Over time code will be migrate to a more object-oriented style, with the eventual goal being able to route all requests throug a single file. 
- Additional security testing. My plan is to use a Kali linux VM to attack an installation in as hard as possible and harden against attacks in the application as I can. System-level exploits will need to be addressed by the user, so a security dashboard will be and eventual, long-term goal.
- Allow for extended functionality with modules and allow for customization of the look via templates (likely powered by Smarty).

### Interested in contributing?
Fork the repository, make your changes, and submit a pull request. Feel free to use this software otherwise per the GNU General Public License v3.0, i.e. no commercial distribution or derivatives are allowed. If you do fork this, I would love to see your changes so please feel free to make pull requests if you think what you've got will be useful or otherwise cool.
