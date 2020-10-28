<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CSIS iLab
 * @subpackage @package CSISJTI
 * @since 1.0.0
 */

?>
			<footer id="site-footer" class="site-footer" role="contentinfo">
				<div class="site-footer__logos">
					<a href="https://www.csis.org" class="site-footer__logo site-footer__logo--csis"><?php include( get_template_directory() . '/assets/static/csis-logo.svg'); ?></a>
					<a href="https://www.climateinvestmentfunds.org/" class="site-footer__logo site-footer__logo--cif"><?php include( get_template_directory() . '/assets/static/cif-logo.svg'); ?></a>
				</div>

				<?php dynamic_sidebar( 'footer-1' ); ?>
				<?php dynamic_sidebar( 'footer-2' ); ?>

				<div class="site-footer__contact">
					<?php dynamic_sidebar( 'social-share' ); ?>
				</div>


				<p class="site-footer__copyright">Copyright &copy;
					<?php
					echo date_i18n(
						/* translators: Copyright date format, see https://secure.php.net/date */
						_x( 'Y', 'copyright date format', 'csisjti' )
					);
					?>
					Center for Strategic and International Studies. All rights reserved. <a href="https://www.csis.org/privacy-policy">Privacy Policy</a>
				</p><!-- .footer-copyright -->

			</footer><!-- #site-footer -->

		</div><!-- .container -->

		<?php wp_footer(); ?>

	</body>
</html>
