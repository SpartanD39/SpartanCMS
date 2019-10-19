# SpartanCMS
Thanks for checking this out. Please read this entire document if you intend to experiment with this.

## What it is
The simplest possible blog/cms thing I can possibly come up with.

### What it can do right now
- Create, edit, view, and delete posts
- Create, edit, delete and view posts according to, user-defined categories.
- Comments on a per-post basis, with comment approval system.
- Super-admin can create new user profiles to allow for multiple authors on a single install.
- User profiles

### What's on the docket
- Code reorganization. Right now code is scattered throughout all files and is likely fairly insecure. Over time code will be migrate to a more object-oriented style, with the eventual goal being able to route all requests throug a single file. 
- Additional security testing. My plan is to use a Kali linux VM to attack an installation in as hard as possible and harden against attacks in the application as I can. System-level exploits will need to be addressed by the user, so a security dashboard will be and eventual, long-term goal.
- Allow for extended site functionality with extension modules and allow for customization of the look via templates (likely powered by Smarty).

### Interested in contributing?
Fork the repository, make your changes, and submit a pull request. Feel free to use this software otherwise per the GNU General Public License v3.0, i.e. no commercial distribution or derivatives are allowed. If you do fork this, I would love to see your changes so please feel free to make pull requests if you think what you've got will be useful or otherwise cool.
