As of Commerce 0.11, we've added an option to allow Hotjar monitoring in the dashboard. This allows the modmore team to see how real users interact with the dashboard, to spot potential problems or improvements. 

**This is completely optional.**

During the Commerce installation process, you will be asked if you want to enable or disable the monitoring. If you choose to disable it, Commerce will work just fine, and we will not be able of seeing your interactions in the dashboard.

## Why?

As we move towards Commerce 1.0, we want to get more insights into how people are using the Commerce dashboard. What features are most used? Is it obvious what certain buttons or tools do? How are people's workflows?
 
Hotjar allows us to get some answers to these questions.

## How / What?

Hotjar can do several things. For Commerce, we're using it primarily to record user sessions. Hotjar will track mouse movements, clicks, scrolls, and html changes. It stores this information on its servers (AWS, located in Ireland), and turns it into video recordings that the modmore team can access and playback later. [You can learn more about how these recordings work in the Hotjar documentation](https://help.hotjar.com/hc/en-us/articles/115011647627-How-do-Hotjar-Recordings-Work).

To prevent Hotjar from collecting sensitive information in these recordings, we have [suppressed parts of the dashboard](https://help.hotjar.com/hc/en-us/articles/115012439167-Suppressing-Sensitive-Data-in-Recordings) that contain customer information (names and addresses), transaction references and tracking references, and we have disabled tracking form field data. We still see your product and order information, and the used URLs in the manager.

Hotjar is only enabled on the Commerce dashboard, and not in the rest of your manager. We do see the full manager in the recordings, including your resource tree and top navigation.

To learn more about Hotjar's data safety and privacy, [see this section in their FAQs](
https://help.hotjar.com/hc/en-us/sections/115003180467-Privacy-Security-and-Operations), and [this recent blog post by founder David Darmanin about Hotjar's approach to privacy](https://www.hotjar.com/blog/hotjar-approach-privacy).

## Anything else?

We also enable polls from time to time. These are shown as small popups in the bottom right of the dashboard that ask the user one or more questions about their experience with the dashboard. They are shown based on certain triggers or after a certain amount of time, and only once or until the user has submitted a response to make sure they don't get annoying.

When you, as site administrator or developer, choose to enable Hotjar, we strongly recommend that you communicate this to your client and the people that use the manager from day to day. 
