            <footer id="footer" role="footer" class="l-footer-wrapper">
                <div class="l-setwidth l-footer" <?php if (!empty($set_width)) : print 'style="max-width:' . $set_width . ';"' ; endif; ?>>
                  <!--footer -->
                  <?php if (is_active_sidebar('sidebar-footer-first')): ?>
                    <div class="footer">
                      <?php dynamic_sidebar('sidebar-footer-first') ?>
                    </div>
                  <?php endif; ?>
                
                  <?php if (is_active_sidebar('sidebar-footer-second')): ?>
                    <div class="footer">
                      <?php dynamic_sidebar('sidebar-footer-second') ?>
                    </div>
                  <?php endif; ?>
                
                  <?php if (is_active_sidebar('sidebar-footer-third')): ?>
                    <div class="footer">
                      <?php dynamic_sidebar('sidebar-footer-third') ?>
                    </div>
                  <?php endif; ?>
                </div>
                <div class="l-setwidth l-footer" <?php if (!empty($set_width)) : print 'style="max-width:' . $set_width . ';"' ; endif; ?>>
                  <div class="footer">
                      <ul class="menu">
                        <li><a href="https://www.alt.ac.uk/accessibility" title="Information about the accessibility of this web site" accesskey="A">Accessibility</a></li>
                        <li><a href="https://www.alt.ac.uk/cookies-policy" title="Use of Cookies">Cookies Policy</a></li>
                        <li><a href="https://www.alt.ac.uk/privacy-policy">Privacy Policy</a></li>
                        <li><a href="https://www.alt.ac.uk/web-site-terms-business">Web Site Terms of Business</a></li>
                        <li><a href="https://www.alt.ac.uk/complaints-policy" title="Complaints Policy and Procedure">Complaints Policy</a></li>
                        <li><a href="https://www.alt.ac.uk/equality-and-diversity-policy-statement" title="Equality and Diversity Policy Statement">Equality and Diversity</a></li>
                    </ul>
                      <p class="social-text"><a href="http://twitter.com/A_L_T"  title="Visit ALT on Twitter" target="_blank"><i class="fa fa-twitter-square"></i></a> <a href="https://google.com/+ALTacuk" target="_blank"   title="Visit ALT on Google+"><i class="fa fa-google-plus-square"></i></a> <a href="http://www.linkedin.com/company/association-for-learning-technology" target="_blank"   title="Visit ALT on LinkedIn"><i class="fa fa-linkedin-square"></i></a> <a href="http://www.youtube.com/user/ClipsFromALT" title="Visit ClipsFromALT on YouTube" target="_blank"><i class="fa fa-youtube-square"></i></a> <a href="https://www.flickr.com/photos/PicsFromALT/" title="Visit PicsFromALT on Flickr" target="_blank"><i class="fa fa-flickr"></i></a> <a href="/feeds" title="See ALT's RSS Feeds"><i class="fa fa-rss-square"></i></a></p><p>Association for Learning Technology | Registered charity number: 1160039<br /><a href="mailto:enquiries@alt.ac.uk" style="color:#fff">enquiries@alt.ac.uk</a> | Tel: +44 (0)1865 819 009</p>
                  </div>
                </div>
            </footer>
		</div>
    </div>
    <a href="#" class="scrolltop" alt="Scroll to the top"><i class="fa fa-chevron-circle-up"></i></a>
  </div>
		<?php wp_footer(); ?>
        <?php echo '<!-- CACHE ' . base64_decode(WP_CACHE_KEY_SALT) . ' -->'; ?>
	</body>
</html>
